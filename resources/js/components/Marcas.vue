<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Busca de Marcas</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <input-container-component  titulo="ID" id="inputID" id-help="idHelp" texto-ajuda="Opcional. Informe o ID">
                                                    <input type="number" class="form-control" id="inputID" aria-describedby="idHelp">
                                                </input-container-component>
                                            </div>
                                            <div class="mb-3">
                                                    <input-container-component  titulo="Nome da Marca" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional. Informe o Nome">
                                                        <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome a Marca">
                                                    </input-container-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

</script>
