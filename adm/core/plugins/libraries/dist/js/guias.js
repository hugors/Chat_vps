 document.addEventListener('DOMContentLoaded', () => {
                    const uploadBox = document.getElementById('upload-box');
                    const fileInput = document.getElementById('file-input');
                    const fileInfo = document.getElementById('file-info');

                    // Função para lidar com o upload de arquivos
                    const handleFileUpload = (file) => {
                        if (file.type === 'application/pdf') {
                            fileInfo.innerHTML = `<p><strong>Arquivo PDF selecionado:</strong> ${file.name}</p>`;
                        } else {
                            fileInfo.innerHTML = `<p class="text-danger">Por favor, selecione um arquivo PDF.</p>`;
                        }
                    };

                    // Função para prevenir o comportamento padrão ao arrastar e soltar
                    const preventDefaults = (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                    };

                    // Função para gerenciar o arraste e soltura
                    const handleDragOver = (e) => {
                        preventDefaults(e);
                        uploadBox.classList.add('drag-over');
                    };

                    const handleDragLeave = () => {
                        uploadBox.classList.remove('drag-over');
                    };

                    const handleDrop = (e) => {
                        preventDefaults(e);
                        uploadBox.classList.remove('drag-over');
                        
                        const file = e.dataTransfer.files[0];
                        if (file) {
                            handleFileUpload(file);
                        }
                    };

                    // Adicionando eventos de arrastar e soltar
                    uploadBox.addEventListener('dragover', handleDragOver);
                    uploadBox.addEventListener('dragleave', handleDragLeave);
                    uploadBox.addEventListener('drop', handleDrop);

                    // Adicionando evento de clique para abrir o seletor de arquivos
                    uploadBox.addEventListener('click', () => fileInput.click());

                    // Adicionando evento para quando o usuário selecionar um arquivo
                    fileInput.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            handleFileUpload(file);
                        }
                    });
                      // Validação para garantir que o arquivo foi selecionado
                        document.getElementById("submit-btn").addEventListener("click", function(event) {
                            const fileInput = document.getElementById("file-input");
                            const errorMessage = document.getElementById("error-message");

                            // Verifica se o arquivo foi selecionado
                            if (!fileInput.files.length) {
                                // Impede o envio do formulário
                                event.preventDefault();

                                // Exibe a mensagem de erro
                                errorMessage.style.display = "block";
                            } else {
                                // Caso tenha arquivo, esconde a mensagem de erro
                                errorMessage.style.display = "none";

                                // Envia o formulário se o arquivo foi selecionado
                                document.getElementById("uploadForm").submit();
                            }
                        });
                });
