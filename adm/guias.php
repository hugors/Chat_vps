<?php

$idSetor = $_SESSION["perfil"];
// 1'ensino', 2'financeiro', 3'professor', 4'fechamento'
//echo $idSetor ;
if ($status =="Fechado"){  //Fechamento Etapa=4
    $ativaGuia4 = "active";
    $guia = "fechamento";
    $ativaConteudo4 = "show active";
       //formata setor 2
       $desativaCampo1  = "disabled";
       include "core/busca/buscaSetor2.php";
       $msgSelect1 = $msgSetor2;
       $msgDescricao = $descricaoSetor2;
    //Fim 
}else {
    if($idSetor ==2){   //divisao ensino Etapa=1
        $guia = "ensino";
        $ativaGuia1 = "active";
        $ativaConteudo1 = "show active";
    //formata inputs Etapa 1
        $msgSelect1 = "Escolher...";
        $msgDescricao = "";
        $desativaCampo1 = "";
    }else if($idSetor ==3){    //financeiro Etapa=2
         //Ativa guia e conteudo Finannceiro 3
          $guia = "financeiro";
          $ativaGuia2 = "active";
          $ativaConteudo2 = "show active";
      //fim
        
        
        
        //formata setor 2
            $desativaCampo1  = "disabled";
            include "core/busca/buscaSetor2.php";
            $msgSelect1 = $msgSetor2;
            $msgDescricao = $descricaoSetor2;
        //Fim 

      

    }else if($idSetor ==4){  //professsor Etapa=3
        //Ativa guia e conteudo professor 4
            $guia = "professor";
            $ativaGuia3 = "active";
            $ativaConteudo3 = "show active";
       
           //formata setor 2
           $desativaCampo1  = "disabled";
           include "core/busca/buscaSetor2.php";
           $msgSelect1 = $msgSetor2;
           $msgDescricao = $descricaoSetor2;
       //Fim  
       
       
    }
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão Escolar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
   
    <style>
        .step-container {
            max-width: 1000px;
            margin: 0 auto 30px;
        }

        .steps-row {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .step-item {
            position: relative;
            flex: 0 1 25%;
            padding: 0 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #495057;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
            border: 3px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .step-circle.active {
            background-color: #0d6efd;
            color: white;
        }

        .step-circle.completed {
            background-color: #198754;
            color: white;
        }

        .step-connector {
            position: absolute;
            top: 20px;
            height: 2px;
            z-index: 1;
        }

        .step-connector.prev {
            left: 0;
            right: 50%;
            margin-right: 20px;
            background-color: #e9ecef;
        }

        .step-connector.next {
            left: 50%;
            right: 0;
            margin-left: 20px;
            background-color: #e9ecef;
        }

        .step-connector.completed {
            background-color: #198754;
        }

        .step-connector.active {
            background-color: #0d6efd;
        }

        .step-connector.future {
            border-top: 2px dashed #e9ecef;
            background-color: transparent;
        }

        .step-text {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
        }

        .step-text.active {
            color: #0d6efd;
            font-weight: bold;
        }

        .step-text.completed {
            color: #198754;
            font-weight: bold;
        }

        .nav-tabs {
            margin-top: 30px;
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            font-weight: 500;
            border: none;
            color: #6c757d;
            padding: 12px 20px;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            background-color: transparent;
        }

        .tab-content {
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
            border-radius: 0 0 8px 8px;
            padding: 25px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .btn-next {
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        
        
        <!-- Step Indicator -->
        <div class="step-container">
            <div class="steps-row">
                <!-- Step 1 -->
                <div class="step-item">
                    <div class="step-circle active">1</div>
                    <div class="step-text active">Divisão Ensino</div>
                    <div class="step-connector next future"></div>
                </div>
                
                <!-- Step 2 -->
                <div class="step-item">
                    <div class="step-connector prev"></div>
                    <div class="step-circle">2</div>
                    <div class="step-text">Financeiro</div>
                    <div class="step-connector next future"></div>
                </div>
                
                <!-- Step 3 -->
                <div class="step-item">
                    <div class="step-connector prev"></div>
                    <div class="step-circle">3</div>
                    <div class="step-text">Professor</div>
                    <div class="step-connector next future"></div>
                </div>
                
                <!-- Step 4 -->
                <div class="step-item">
                    <div class="step-connector prev"></div>
                    <div class="step-circle">4</div>
                    <div class="step-text">Fechamento</div>
                </div>
            </div>
        </div>
        
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $ativaGuia1 ;?>" id="ensino-tab" data-bs-toggle="tab" data-bs-target="#ensino" type="button" role="tab" aria-controls="ensino" aria-selected="true">
                    <i class="fas fa-graduation-cap me-2"></i> Divisão Ensino
                </button>
            </li>
            <li class="nav-item " role="presentation">
                <button class="nav-link <?php echo $ativaGuia2 ;?>" id="financeiro-tab" data-bs-toggle="tab" data-bs-target="#financeiro" type="button" role="tab" aria-controls="financeiro" aria-selected="false">
                    <i class="fas fa-money-bill-wave me-2"></i> Financeiro
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $ativaGuia3 ;?>" id="professor-tab" data-bs-toggle="tab" data-bs-target="#professor" type="button" role="tab" aria-controls="professor" aria-selected="false">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Professor
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $ativaGuia4 ;?>" id="fechamento-tab" data-bs-toggle="tab" data-bs-target="#fechamento" type="button" role="tab" aria-controls="fechamento" aria-selected="false">
                    <i class="fas fa-check-circle me-2"></i> Fechamento
                </button>
            </li>
        </ul>
        
       <!-- Tab Content -->
       <input type="text" name="idSetor" value="<?php echo $idSetor; ?> " hidden>
       <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade <?php echo $ativaConteudo1 ; ?>" id="ensino" role="tabpanel" aria-labelledby="ensino-tab">
                <h4 class="mb-4">Gestão do Ensino</h4>
              
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Aprovar Processo</label>
                        <div class="input-group">
                            <select class="custom-select" id="aprovRde" name="aprovRde" required <?php echo $desativaCampo1 ; ?>>
                                <option value=""><?php echo $msgSelect1  ; ?></option>
                                <option value="1">Deferir</option>
                                <option value="0">Indeferir</option> 
                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Descrição da Divis˜ão de Ensino:</label>
                        <textarea class="form-control" name="descricaoDivEnsi"  id="descricaoDivEnsi"  rows="3" required <?php echo $desativaCampo1 ; ?>><?php echo $msgDescricao ; ?></textarea>
                        <small><i class="fas fa-exclamation-circle" style="color: red;"></i> Obrigatório preenchimento da descriçao para fechar protocolo</small>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary btn-next next-step mt-3" >Próxima Etapa →</button>
                </div>
            </div>
            
            <div class="tab-pane fade <?php echo $ativaConteudo2 ; ?>" id="financeiro" role="tabpanel" aria-labelledby="financeiro-tab">
                <h4 class="mb-4">Gestão Financeira</h4>
                <i class="fas fa-bullhorn" style="color: #820719;"></i> Nessa Etapa basta anexar o Boleto de pagamento e clicar no botão Proxima Etapa somente depois da baixa do pagamento
                    <p>  
                <!-- Inicio do upload -->
                         <div class="text-center">
                                <div class="upload-box p-5 border rounded-3" id="upload-box">
                                    <!-- Ícone de Upload -->
                                    <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #007bff;"></i>
                                    <p>Arraste e solte seu arquivo PDF aqui ou clique para selecionar.</p>
                                    <!-- Atribuindo 'name' ao input -->
                                    <input type="file" name="pdfFile" id="file-input" accept="application/pdf" hidden>
                                </div>
                            </div>
                            
                            <div id="file-info" class="mt-3 text-center"></div>
                        <!-- Mensagem de erro, caso o arquivo não tenha sido selecionado -->
                        <div id="error-message" class="text-danger text-center mt-3" style="display: none;">
                            <p>Por favor, selecione um arquivo PDF antes de enviar.</p>
                        </div>
                        <input type="checkbox" name="baixaBoleto" value="1">  Boleto foi baixado.
                    <!--FIM-->
                
                
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary btn-next next-step" >Próxima Etapa →</button>
                </div>
               
            </div>

            <div class="tab-pane fade <?php echo $ativaConteudo3 ; ?>" id="professor" role="tabpanel" aria-labelledby="professor-tab">
                <h4 class="mb-4">Gestão de Professores</h4>
                <iframe src="core/busca/buscaDisciplinaProfessor.php" width="100%" height="700" frameborder="0" scrolling="auto" frameborder></iframe>

               
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary btn-next next-step">Próxima Etapa →</button>
                </div>
            </div>
            
            <div class="tab-pane fade <?php echo $ativaConteudo4 ; ?>" id="fechamento" role="tabpanel" aria-labelledby="fechamento-tab">
                <h4 class="mb-4">Fechamento do Processo</h4>
                O protocolo foi finalizado na etapa de professores, navegue pelas guias, e verifique todas as etapas
               
               <!-- <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success">Finalizar Processo</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SCRIPT do UPLOAD -->
    <script >
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
});

    </script>

    
    <!-- FIM do SCRIPT UPLOAD -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Atualiza o indicador de etapas quando as abas são alteradas
        const tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabElms.forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', function(event) {
                const activeTab = event.target.getAttribute('aria-controls');
                updateStepIndicator(activeTab);
            });
        });
        
        // Botões de próxima etapa
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', function() {
                const currentPane = this.closest('.tab-pane');
                const nextTab = currentPane.nextElementSibling?.getAttribute('id') + '-tab';
                
                if (nextTab) {
                    bootstrap.Tab.getOrCreateInstance(document.getElementById(nextTab)).show();
                }
            });
        });
        
        // Botões de etapa anterior
        document.querySelectorAll('.prev-step').forEach(button => {
            button.addEventListener('click', function() {
                const currentPane = this.closest('.tab-pane');
                const prevTab = currentPane.previousElementSibling?.getAttribute('id') + '-tab';
                
                if (prevTab) {
                    bootstrap.Tab.getOrCreateInstance(document.getElementById(prevTab)).show();
                }
            });
        });
        
        const guiaSelecionada = <?php echo json_encode($guia); ?>;
        
        // Função para atualizar o indicador visual das etapas
        function updateStepIndicator(activeTab) {
            const steps = ['ensino', 'financeiro', 'professor', 'fechamento'];
            const activeIndex = steps.indexOf(activeTab);
            
            document.querySelectorAll('.step-item').forEach((item, index) => {
                const circle = item.querySelector('.step-circle');
                const text = item.querySelector('.step-text');
                const prevConnector = item.querySelector('.step-connector.prev');
                const nextConnector = item.querySelector('.step-connector.next');
                
                // Reset classes
                circle.classList.remove('active', 'completed');
                text.classList.remove('active', 'completed');
                if (prevConnector) prevConnector.classList.remove('completed', 'active', 'future');
                if (nextConnector) nextConnector.classList.remove('completed', 'active', 'future');
                
                // Set current state
                if (index < activeIndex) {
                    // Etapas anteriores completadas
                    circle.classList.add('completed');
                    text.classList.add('completed');
                    if (prevConnector) prevConnector.classList.add('completed');
                    if (nextConnector) nextConnector.classList.add('completed');
                } else if (index === activeIndex) {
                    // Etapa atual ativa
                    circle.classList.add('active');
                    text.classList.add('active');
                    if (prevConnector) prevConnector.classList.add('completed');
                    if (nextConnector) nextConnector.classList.add('future');
                    
                    // Se for a última etapa (fechamento), marca como concluída
                    if (activeTab === 'fechamento') {
                        circle.classList.add('completed');
                        text.classList.add('completed');
                        if (prevConnector) prevConnector.classList.add('completed');
                        if (nextConnector) nextConnector.classList.add('completed');
                    }
                } else {
                    // Etapas futuras
                    if (prevConnector) prevConnector.classList.add('future');
                }
            });
        }
        
        // Inicializa o indicador
        updateStepIndicator(guiaSelecionada);
    });
</script>
</body>
</html>