const qrcode = require('qrcode-terminal');
const { Client, MessageTypes, MessageMedia, List, Buttons, LocalAuth } = require('whatsapp-web.js');
const cron = require('node-cron');
const fs = require('fs');
const { google } = require('googleapis');
const moment = require('moment-timezone');

// Configuração do cliente WhatsApp
const client = new Client({
    authStrategy: new LocalAuth(),
    puppeteer: { 
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    }
});

// Configuração do Google Sheets
const credentials = JSON.parse(fs.readFileSync('booming-being-453614-q4-7f7130893d46.json', 'utf8'));
const auth = new google.auth.GoogleAuth({
    credentials,
    scopes: ['https://www.googleapis.com/auth/spreadsheets', 'https://www.googleapis.com/auth/calendar'],
});
const spreadsheetId = '1Ver6-XRNFTdc04JsbJfUQJVI-HI4sfxXHoQPnF1lb_I';

// Variáveis de estado
let isAuthenticated = false;
let isMainInitialized = false;
const state = {};
const clientStates = {};
let iniciarPlanilhas = false;
let iniciandoFluxoPrincipal = false;

// Função para converter data para formato ISO
function convertDateToISOFormat(date) {
    const [day, month, year] = date.split('/');
    return `${year}-${month}-${day}`;
}

// Função de saudação
function saudacao() {
    const data = new Date();
    const hora = data.getHours();
    let str = '';

    if (hora >= 6 && hora < 12) {
        str = '🌞 *Bom dia!*';
    } else if (hora >= 12 && hora < 18) {
        str = '🌅 *Boa tarde!*';
    } else {
        str = '🌙 *Boa noite!*';
    }
    return str;
};

// Função de delay
const delay = ms => new Promise(res => setTimeout(res, ms));

// Eventos do WhatsApp
client.on('qr', qr => {
    console.log('QRCode recebido, por favor escaneie:');
    qrcode.generate(qr, { small: true });
    isAuthenticated = false;
});

client.on('authenticated', () => {
    console.log('Autenticado com sucesso!');
    isAuthenticated = true;
});

client.on('ready', async () => {
    console.log('Cliente pronto!');
    if (!isMainInitialized) {
        await main();
    }
});

// Função para aguardar autenticação
function waitForAuthentication() {
    return new Promise((resolve) => {
        const checkAuth = setInterval(() => {
            if (isAuthenticated) {
                clearInterval(checkAuth);
                resolve();
            }
        }, 1000);
    });
}

// Função principal
async function main() {
    if (isMainInitialized) {
        console.log('O fluxo principal já foi iniciado. Ignorando');
        return;
    }

    isMainInitialized = true;

    try {
        // Aguardar autenticação antes de continuar
        await waitForAuthentication();

        console.log('Iniciando o fluxo principal...');

        // 1. Inicia o fluxo principal de atendimento
        fluxoPrincipal();

        // 2. Configurar intervalos somente após autenticação
        setupIntervals();

        console.log('Fluxo principal iniciado com sucesso.');
    } catch (error) {
        console.error('Erro no fluxo principal:', error);
    }
}

// Configuração dos intervalos
function setupIntervals() {
    // Intervalo para planilha (iniciar somente após autenticação)
    const planilhaInterval = setInterval(() => {
        if (isAuthenticated) {
            console.log('Verificando planilha...');
            addDataToSheet().catch(console.error);
        } else {
            clearInterval(planilhaInterval);
        }
    }, 60000);

    // Intervalo para limpeza
    setInterval(() => {
        if (isAuthenticated) {
            console.log('Limpando planilha...');
            limparPlanilha().catch(console.error);
        }
    }, 24 * 60 * 60 * 1000);
}

// Fluxo principal de atendimento
async function fluxoPrincipal() {
    if (iniciandoFluxoPrincipal) {
        console.log('Fluxo principal já iniciado. Ignorando...');
        return;
    }

    iniciandoFluxoPrincipal = true;

    client.on('message', async msg => {
        if (msg.isGroup || msg.from.endsWith('@g.us')) {
            return;
        };

        // Funções auxiliares para envio de mensagens
        async function enviarMensagemTexto(texto) {
            await delay(3000);
            await chat.sendStateTyping();
            await delay(3000);
            await client.sendMessage(msg.from, texto);
        };

        async function enviarMensagemInicial(img, texto) {
            await delay(3000);
            await chat.sendStateTyping();
            await delay(3000);
            await client.sendMessage(msg.from, img, { caption: texto });
        };

        const from = msg.from;
        const mensagem = msg.body || msg.from.endsWith('@c.us');
        const chat = await msg.getChat();
        const contato = await msg.getContact();
        const nome = contato.pushname;
        const saudacoes = ['oi', 'bom dia', 'boa tarde', 'olá', 'Olá', 'Oi', 'Boa noite', 'Bom Dia', 'Bom dia', 'Boa Tarde', 'Boa tarde', 'Boa Noite', 'boa noite'];
        const logo = MessageMedia.fromFilePath('./logo_exemplo.jpg');
        const sauda = saudacao();
        const mensagemInicial = `${sauda}\n${nome} \n*Sou o Bot, seu assistente virtual!*\n_Como posso ajudar?_\n\n➡️ Por favor, digite o *NÚMERO* de uma das opções abaixo:\n\n1️⃣ - Opção 1\n2️⃣ - Opção 2\n3️⃣ - Opção 3\n4️⃣ - Opção 4\n5️⃣ - Opção 5`;
        const MAX_ATTEMPTS = 3;
        
        if (!state[from]) state[from] = { attempts: 0, step: 0 };
        const userState = state[from];

        if (userState.step === 0) {
            if (saudacoes.some(palavra => msg.body.includes(palavra))) {
                state[from].step = 1;
                await enviarMensagemInicial(logo, mensagemInicial);
                return;
            }
        } else if (userState.step === 1) {
            switch (mensagem) {
                case "1":
                    await enviarMensagemTexto('Este é um exemplo de navegação para a opção 1');
                    await enviarMensagemTexto('*O que deseja fazer agora?*\n\n0️⃣ - Sair\n1️⃣ - Menu inicial');
                    state[from] = { step: 2 };
                    return;

                case "2":
                    await enviarMensagemTexto('Este é um exemplo de navegação para a opção 2');
                    await enviarMensagemTexto('*O que deseja fazer agora?*\n\n0️⃣ - Sair\n1️⃣ - Menu inicial');
                    state[from] = { step: 2 };
                    return;

                case "3":
                    await enviarMensagemTexto('Este é um exemplo de navegação para a opção 3');
                    await enviarMensagemTexto('*O que deseja fazer agora?*\n\n0️⃣ - Sair\n1️⃣ - Menu inicial');
                    state[from] = { step: 2 };
                    return;

                case "4":
                    await enviarMensagemTexto('Este é um exemplo de navegação para a opção 4');
                    await enviarMensagemTexto('*O que deseja fazer agora?*\n\n0️⃣ - Sair\n1️⃣ - Menu inicial');
                    state[from] = { step: 2 };
                    return;

                case "5":
                    await enviarMensagemTexto('Este é um exemplo de navegação para a opção 5');
                    await enviarMensagemTexto('*O que deseja fazer agora?*\n\n0️⃣ - Sair\n1️⃣ - Menu inicial');
                    state[from] = { step: 2 };
                    return;

                default:
                    if (userState.attempts === undefined) userState.attempts = 0;
                    userState.attempts++;
                    const tentativasRestantes = MAX_ATTEMPTS - userState.attempts;
                    if (userState.attempts >= MAX_ATTEMPTS) {
                        await client.sendMessage(
                            msg.from,
                            '❌ *Número de tentativas excedido!*\nAtendimento finalizado!\n\nDigite *Oi* para iniciar.'
                        );
                        state[from] = { step: 0, attempts: 0 };
                        delete state[from]; 
                    } else {
                        await client.sendMessage(
                            msg.from,
                            `❌ *Opção inválida!*\nVocê tem mais ${tentativasRestantes} tentativa(s).`
                        );
                    }
                    return;
            }
        } else if (userState.step === 2) {
            switch(mensagem) {
                case "0":
                    await enviarMensagemTexto('😉 Tudo bem!\n👋 *Até logo!*');
                    delete state[from];
                    return;

                case "1":
                    await enviarMensagemTexto('😉 Tudo bem!\nVamos começar de novo...');
                    await enviarMensagemInicial(logo, mensagemInicial);
                    state[from] = { step: 1 };
                    return;

                default:
                    if (userState.attempts === undefined) userState.attempts = 0;
                    userState.attempts++;
                    const tentativasRestantes = MAX_ATTEMPTS - userState.attempts;
                    if (userState.attempts >= MAX_ATTEMPTS) {
                        await client.sendMessage(
                            msg.from,
                            '❌ *Número de tentativas excedido!*\nAtendimento finalizado!\n\nDigite *Oi* para iniciar.'
                        );
                        state[from] = { step: 0, attempts: 0 };
                        delete state[from]; 
                    } else {
                        await client.sendMessage(
                            msg.from,
                            `❌ *Opção inválida!*\nVocê tem mais ${tentativasRestantes} tentativa(s).`
                        );
                    }
                    return;
            }
        }
    });
}

// Função para adicionar dados à planilha
async function addDataToSheet() {
    if (iniciarPlanilhas) return;

    iniciarPlanilhas = true;

    try {
        const authClient = await auth.getClient();
        const sheets = google.sheets({ version: 'v4', auth: authClient });

        const response = await sheets.spreadsheets.values.get({
            spreadsheetId,
            range: 'A:K',
        });

        const rows = response.data.values || [];
        if (rows.length) {
            for (const [index, row] of rows.entries()) {
                const [name, phone, status, date1, date2, date3, hour1, hour2, hour3, dateok, hourok] = row;

                const whatsappId = `55${phone}@c.us`;

                if (status === 'Agendar' && !clientStates[whatsappId]) {
                    clientStates[whatsappId] = { row: index + 1, name, date1, date2, date3, hour1, hour2, hour3 };

                    const message = `🙋‍♂️ *Olá, ${name}, tenho uma ótima notícia para você!*\n\n😃 Seu projeto está pronto!\n_Vamos marcar a apresentação?_\n\nPor favor escolha uma das datas abaixo por favor: \n1️⃣ - ${date1}\n2️⃣ - ${date2}\n3️⃣ - ${date3}`;
                    await client.sendMessage(whatsappId, message);

                    console.log(`Mensagem enviada para ${whatsappId}`);

                    await sheets.spreadsheets.values.update({
                        spreadsheetId,
                        range: `C${index + 1}`,
                        valueInputOption: 'RAW',
                        resource: { values: [['Notificado']] },
                    });
                }
            }
        }
    } catch (error) {
        console.error('Erro ao processar planilha:', error);
    } finally {
        iniciarPlanilhas = false;
    }
}

// Handler para respostas de agendamento
client.on('message', async (message) => {
    const clientResponse = message.body.trim();
    const phone = message.from;

    if (clientStates[phone]) {
        const { row, name, date1, date2, date3, hour1, hour2, hour3, dateok, hourok } = clientStates[phone];

        if (['1', '2', '3'].includes(clientResponse)) {
            const dataEscolhida = clientResponse === '1' ? date1 : clientResponse === '2' ? date2 : date3;

            await client.sendMessage(
                phone,
                `😃 *Maravilha, ${name}!* Você escolheu a data: ${dataEscolhida}. \n Agora escolha um horário por favor:\n\n4️⃣ - ${hour1}\n5️⃣ - ${hour2}\n6️⃣ - ${hour3}`
            );

            const authClient = await auth.getClient();
            const sheets = google.sheets({ version: 'v4', auth: authClient });
            await sheets.spreadsheets.values.update({
                spreadsheetId,
                range: `J${row}`,
                valueInputOption: 'RAW',
                resource: { values: [[dataEscolhida]] },
            });

            clientStates[phone].dataEscolhida = dataEscolhida;
        } else if (['4', '5', '6'].includes(clientResponse)) {
            const horaEscolhida = clientResponse === '4' ? hour1 : clientResponse === '5' ? hour2 : hour3;

            await client.sendMessage(phone, `😃 *Maravilha, ${name}!* Você escolheu agendar para:\n ${clientStates[phone].dataEscolhida} às ${horaEscolhida}.\n\nConfirmado?\n#️⃣ - SIM\n0️⃣ - NÃO`);
            
            const authClient = await auth.getClient();
            const sheets = google.sheets({ version: 'v4', auth: authClient });
            await sheets.spreadsheets.values.update({
                spreadsheetId,
                range: `K${row}`,
                valueInputOption: 'RAW',
                resource: { values: [[horaEscolhida]] },
            });    
            
            clientStates[phone].horaEscolhida = horaEscolhida;
        } else if (clientResponse.toLowerCase() === '#') {
            // Confirmar apresentação
            const authClient = await auth.getClient();
            const sheets = google.sheets({ version: 'v4', auth: authClient });
            await sheets.spreadsheets.values.update({
                spreadsheetId,
                range: `C${row}`,
                valueInputOption: 'RAW',
                resource: { values: [['Confirmado']] },
            });
            const calendarLink = await criarEventoCalendario(name, clientStates[phone].dataEscolhida, clientStates[phone].horaEscolhida, phone);

            await client.sendMessage(
                phone,
                `😃 *Ótimo, ${name}!* Sua apresentação está confirmada para:\n\n ${clientStates[phone].dataEscolhida} às ${clientStates[phone].horaEscolhida}.`
            );

            // Remover cliente do estado temporário
            delete clientStates[phone];
        } else if (clientResponse === '0') {
            await client.sendMessage(phone, `😉 Tudo bem!\nDeseja rever as datas e horários apresentados novamente?\n\n8️⃣ - SIM\n9️⃣ - NÃO`);
        } else if (clientResponse === '8') {
            const authClient = await auth.getClient();
            const sheets = google.sheets({ version: 'v4', auth: authClient });
            await sheets.spreadsheets.values.update({
                spreadsheetId,
                range: `C${row}`,
                valueInputOption: 'RAW',
                resource: { values: [['Agendar']] },
            });
        } else {
            await client.sendMessage(phone, '😉 Até logo!');
            delete clientStates[phone];
            return;    
        }
    }
});

// Função para criar evento no Google Calendar
async function criarEventoCalendario(name, date, time, phone) {
    try {
        const authClient = await auth.getClient();
        const calendar = google.calendar({ version: 'v3', auth: authClient });

        const dataFormatada = convertDateToISOFormat(date);

        const eventStartDateTime = moment.tz(`${dataFormatada} ${time}`, 'YYYY-MM-DD HH:mm', 'America/Sao_Paulo').toDate();
        const eventEndDateTime = moment(eventStartDateTime).add(1, 'hours').toDate();

        const event = {
            summary: `Apresentação de Projeto - ${name}`,
            description: `Apresentação de projeto para ${name}.`,
            start: {
                dateTime: eventStartDateTime.toISOString(),
                timeZone: 'America/Sao_Paulo',
            },
            end: {
                dateTime: eventEndDateTime.toISOString(),
                timeZone: 'America/Sao_Paulo',
            },
        };

        const createdEvent = await calendar.events.insert({
            calendarId: 'bihugorosa@gmail.com',
            resource: event,
        });

        console.log(`Adicionado com sucesso: ${createdEvent.data.htmlLink}`);
        return createdEvent.data.htmlLink;
    } catch (error) {
        console.error('Erro ao adicionar na agenda da empresa:', error);
    }
}

// Função para limpar planilha
async function limparPlanilha() {
    try {
        const authClient = await auth.getClient();
        const sheets = google.sheets({ version: 'v4', auth: authClient });

        const response = await sheets.spreadsheets.values.get({
            spreadsheetId,
            range: 'A:K',
        });
        const rows = response.data.values || [];
        const now = new Date();

        if (rows.length) {
            const updates = [];
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const [name, phone, status, date1, date2, date3, hour1, hour2, hour3, dateok, hourok] = row;

                if (!dateok) continue;

                const isoFormattedDate = convertDateToISOFormat(dateok);
                const scheduledDate = new Date(isoFormattedDate);

                if (now - scheduledDate > 15 * 24 * 60 * 60 * 1000) {
                    console.log(`Limpando linha ${i + 1} - Nome: ${name}`);

                    updates.push({
                        range: `A${i + 1}:K${i + 1}`,
                        values: [['', '', 'Selecionar', '', '', '', '', '', '', '', '']],
                    });
                }
            }

            if (updates.length > 0) {
                await sheets.spreadsheets.values.batchUpdate({
                    spreadsheetId,
                    resource: { data: updates, valueInputOption: 'RAW' },
                });
                console.log('Linhas limpas e status retornado para Andamento');
            } else {
                console.log('Ainda não foi preciso limpar a planilha');
            }
        }
    } catch (error) {
        console.error('Ocorreu um erro ao limpar a planilha', error);
    }
}

// Inicialização do cliente (AGORA CORRETAMENTE POSICIONADA NO FINAL)
client.initialize().catch(err => {
    console.error('Erro na inicialização:', err);
    process.exit(1);
});