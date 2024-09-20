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
                            <label class="small mb-1" for="inputNotificationEmail">Destino</label>
                            <input type="text" name="cidade" class="form-control" placeholder="digite o nome do local que tu quer visitar">
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

                           <div class="mb-0">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkAdventure" type="checkbox" name="personalidade[]" value="Gosto de aventuras e atividades ao ar livre">
                                    <label class="form-check-label" for="checkAdventure">
                                        Gosto de aventuras e atividades ao ar livre
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkCultural" type="checkbox" name="personalidade[]" value="Tenho interesse por cultura e museus">
                                    <label class="form-check-label" for="checkCultural">
                                        Tenho interesse por cultura e museus
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkRelax" type="checkbox" name="personalidade[]" value="Prefiro relaxar em locais tranquilos">
                                    <label class="form-check-label" for="checkRelax">
                                        Prefiro relaxar em locais tranquilos
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkGastronomy" type="checkbox" name="personalidade[]" value="Aprecio experiências gastronômicas">
                                    <label class="form-check-label" for="checkGastronomy">
                                        Aprecio experiências gastronômicas
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkNightlife" type="checkbox" name="personalidade[]" value="Gosto de vida noturna e eventos sociais">
                                    <label class="form-check-label" for="checkNightlife">
                                        Gosto de vida noturna e eventos sociais
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkShopping" type="checkbox" name="personalidade[]" value="Aprecio fazer compras e visitar mercados locais">
                                    <label class="form-check-label" for="checkShopping">
                                        Aprecio fazer compras e visitar mercados locais
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkHistory" type="checkbox" name="personalidade[]" value="Tenho interesse por história e locais históricos">
                                    <label class="form-check-label" for="checkHistory">
                                        Tenho interesse por história e locais históricos
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkSports" type="checkbox" name="personalidade[]" value="Gosto de esportes e atividades físicas">
                                    <label class="form-check-label" for="checkSports">
                                        Gosto de esportes e atividades físicas
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkNature" type="checkbox" name="personalidade[]" value="Prefiro locais com muita natureza e paisagens naturais">
                                    <label class="form-check-label" for="checkNature">
                                        Prefiro locais com muita natureza e paisagens naturais
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkLuxury" type="checkbox" name="personalidade[]" value="Aprecio experiências de luxo e hotéis 5 estrelas">
                                    <label class="form-check-label" for="checkLuxury">
                                        Aprecio experiências de luxo e hotéis 5 estrelas
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" id="checkPhotography" type="checkbox" name="personalidade[]" value="Tenho interesse em fotografia e cenários fotogênicos">
                                    <label class="form-check-label" for="checkPhotography">
                                        Tenho interesse em fotografia e cenários fotogênicos
                                    </label>
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