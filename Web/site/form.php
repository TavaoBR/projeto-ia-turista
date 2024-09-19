<?=$this->layout('themas/site', ['title' => $title]);?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link href="<?=Assests("/")?>assets/css/form.css" rel="stylesheet">

<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-lg-8">
        <?=validateSession("Message")?>
            <!-- Email notifications preferences card-->
            <div class="card card-header-actions mb-4">
                <div class="card-header">
                    Roteiro
                </div>
                <div class="card-body">
                    <form  method="POST" action="<?=routerConfig()?>/form">
                        <!-- Form Group (default email)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputNotificationEmail">Seu nome</label>
                            <input class="form-control" id="inputNotificationEmail" type="text" name="nome" >
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputNotificationEmail">Cidade destino</label>
                            <select name="cidade" id="cidadeSelect" class="form-control mySelect2" >
                                <option value="">Escolha uma opção</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputNotificationEmail">Está indo ?</label>
                            <select name="acompanhado" id="" class="form-control">
                                   <option value="">Selecione uma opção</option>
                                   <option value="Sozinho">Sozinho</option>   
                                   <option value="Com meu cônjuge">Com meu cônjuge</option>  
                                   <option value="Em familía">Em familía</option>  
                                   <option value="Com amigos">Com amigos</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputNotificationEmail">Quantos dias ?</label>
                             <input type="number" name="dias" id="" minlength="1" maxlength="10" class="form-control">
                        </div>



                        <!-- Form Group (email updates checkboxes)-->
                        <div class="mb-0">
                            <label class="small mb-2">Escolhas algumas opções</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" id="checkAccountChanges" type="checkbox" name="passeios[]" value="Atrações Culturais">
                                <label class="form-check-label" for="checkAccountChanges">Atrações Culturais</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" id="checkAccounthistorico" type="checkbox" name="passeios[]" value="Atrações históricas">
                                <label class="form-check-label" for="checkAccounthistorico">Atrações históricas</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" id="checkAccountGroups" type="checkbox" name="passeios[]" value="Passeios gastronômicos">
                                <label class="form-check-label" for="checkAccountGroups">Passeios gastronômicos</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" id="checkProductUpdates" type="checkbox" name="passeios[]" value="Passeios Noturnas">
                                <label class="form-check-label" for="checkProductUpdates">Passeios Noturnas</label>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-success">Gerar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Notifications preferences card-->
            <div class="card">
                <div class="card-header">Notification Preferences</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (notification preference checkboxes)-->
                        <div class="form-check mb-2">
                            <input class="form-check-input" id="checkAutoGroup" type="checkbox" checked="">
                            <label class="form-check-label" for="checkAutoGroup">Automatically subscribe to group notifications</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="checkAutoProduct" type="checkbox">
                            <label class="form-check-label" for="checkAutoProduct">Automatically subscribe to new product notifications</label>
                        </div>
                        <!-- Submit button-->
                        <button class="btn btn-danger-soft text-danger">Unsubscribe from all notifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

$('.mySelect2').select2();

// Aqui está a solução
$('.mySelect2').on('select2:unselect', function(evt) {
console.log(evt.params.data);
})

        // Função para buscar e popular o select com os municípios
        async function carregarCidades() {
            try {
                // Fazer a requisição à API do IBGE
                const resposta = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/distritos?orderBy=nome');
                
                // Converter a resposta em JSON
                const distritos = await resposta.json();
                
                // Obter o select do DOM
                const selectCidade = document.getElementById('cidadeSelect');
                
                // Manter um controle dos municípios já adicionados (evitar duplicatas)
                const municipiosAdicionados = new Set();
                
                // Iterar sobre os distritos e adicionar apenas os municípios
                distritos.forEach(distrito => {
                    const nomeMunicipio = distrito.municipio.nome;
                    const nomeEstado = distrito.municipio.microrregiao.mesorregiao.UF.nome;

                    // Verificar se o município já foi adicionado
                    if (!municipiosAdicionados.has(nomeMunicipio)) {
                        const opcao = document.createElement('option');
                        opcao.value = `${nomeMunicipio}-${nomeEstado}`; // Concatenar município e estado com "-"
                        opcao.textContent = `${nomeMunicipio} - ${nomeEstado}`;
                        
                        // Adicionar o município ao select e ao Set de controle
                        selectCidade.appendChild(opcao);
                        municipiosAdicionados.add(nomeMunicipio);
                    }
                });
            } catch (erro) {
                console.error('Erro ao carregar os municípios:', erro);
            }
        }

        // Chamar a função ao carregar a página
        carregarCidades();
    </script>