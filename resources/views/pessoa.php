<link href="<?=$url?>public/assets/dist/css/mobi.cadastro.css" rel="stylesheet" />
<link href="<?=$url?>public/assets/plugins/iCheck/all.css" rel="stylesheet">
<link href="<?=$url?>public/assets/plugins/select2/select2.min.css" rel="stylesheet" />
<link href="<?=$url?>public/assets/dist/css/sweetalert.css" rel="stylesheet" />
<link href="<?=$url?>public/assets/plugins/kendo/kendo.common.min.css" rel="stylesheet" />
<link href="<?=$url?>public/assets/plugins/kendo/kendo.default.min.css" rel="stylesheet" />
<style>
    .k-state-selected, .k-state-selected:link, .k-state-selected:visited, .k-list > .k-state-selected, .k-list > .k-state-highlight, .k-panel > .k-state-selected, .k-ghost-splitbar-vertical, .k-ghost-splitbar-horizontal, .k-draghandle.k-state-selected:hover, .k-scheduler .k-scheduler-toolbar .k-state-selected, .k-scheduler .k-today.k-state-selected, .k-marquee-color {
        color: #ffffff;
        background-color: #3c8dbc;
        border-color: #3c8dbc;
    }

    .k-state-selected, .k-state-selected:link, .k-state-selected:visited, .k-list > .k-state-selected, .k-list > .k-state-highlight, .k-panel > .k-state-selected, .k-ghost-splitbar-vertical, .k-ghost-splitbar-horizontal, .k-draghandle.k-state-selected:hover, .k-scheduler .k-scheduler-toolbar .k-state-selected, .k-scheduler .k-today.k-state-selected, .k-marquee-color {
        color: #ffffff;
        background-color: #3c8dbc;
        border-color: #3c8dbc;
    }

    #gridtemplate tbody tr:hover {
        background: #3c8dbc;
    }

    .label-black{
        background: #000 !important;
    }

    .toolbar {
        float: right;
    }
    .pesquisaData{
        display: none;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        
        <br>
        <div class="row">
            <div id="divErros" class="col-xs-12" style="margin-bottom: -15px">
               
               <?php
                    if (isset($_SESSION['ERROR'])) {
                   
               ?>
                <div class="callout callout-danger bg-red disabled color-palette">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Alerta!</h4>
                    <div id="erros" hidden data='{!! json_encode(array_keys($errors->default->messages())) !!}'></div>
                    <ul>
                       
                            <li> error </li>
                        
                    </ul>
                </div>
               
                <div class="callout callout-danger bg-red disabled color-palette">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Alerta!</h4>
                    <ul>
                        <li> error </li>
                    </ul>
                </div>
                
                <?php
                    }
                ?>

            </div>
        </div>

    </div>
</div>
<script type="text/x-kendo-template" id="template">
    
    <a type="button" id="btnInserir" href="<?=$url?>pessoa/inserir" class="btn btn-default">Inserir<i class=""></i></a>

    <div class="toolbar"><button type="button" id="btnAtualizar" class="btn btn-default"><i class="fa fa-refresh"></i></button></div>

</script>

<div class="row" style="margin-bottom: 5px">
        <div class="col-xs-12">
        <label style="font-weight: bold; color: #000">Empresa:</label>
        <select class="form-control" id="idempresa" data-placeholder="Selecione" style="width: 100%;">
            <?php
                if($_SESSION['usuario']['proprietario'] == 'S'){

            ?>
            <option value="<?=$_SESSION['matriz']['id']?>" selected="selected"><?=$_SESSION['matriz']['id']?> - <?=$_SESSION['matriz']['nomefantasia']?></option>
            
            <?php
                foreach ($_SESSION['filiais'] as $filiais) {
                    echo "<option value='".$filiais['id']."'>".$filiais['id']." - ".$filiais['nomefantasia']."</option>";
                }
                }
            ?>
        </select>
        
       
    </div>
</div>

<div class="row" style="margin-bottom: 5px">
    <div class="col-xs-3">
        <label class="pesquisaData"> </label>            
        <select class="form-control select2" id="idFiltro" data-placeholder="Selecione" style="width: 100%;">
           <option value="codigo" name="cod">Código</option>
           <option value="codigo_pe" name="cod_pe">Código Personalizados</option>
           <option value="razao_social" name="razao_social">Razão Social</option>
        </select>
    </div>
        
<div class="pesquisaData">    
    <div class="col-xs-2" style="margin-left:-24px">
        <label>Data inicial</label>
        <input type="date" value="{{$dataInicial == '' ? date('Y-m-d') : $dataInicial}}" class="form-control" id="dataInicial" />
    </div>  
    <div class="col-xs-2" style="margin-left:-24px">
        <label>Data final</label>        
        <input type="date" value="{{$dataFinal or date('Y-m-d')}}" class="form-control" id="dataFinal" />
    </div>        
</div>    
    <div class="col-xs-3" style="margin-left:-24px">
        <label class="pesquisaData"> </label>
        <input class="form-control" id="inputPesquisa" />
    </div>
    <div class="col-xs-1" style="margin-left:-24px">
        <label class="pesquisaData"> </label>
        <button type="button" id="btnPesquisar" class="btn btn-default"><i class="fa fa-search"></i></button>
    </div>
</div>

<div id="gridtemplate" style="background-color: #eae8e8; border-width: 0 0 1px solid; margin: 0; padding: .22em .2em .28em; cursor: default;">
    <a type="button" id="btnInserir" href="<?=$url?>pessoa/inserir" class="btn btn-default">Inserir<i class=""></i></a>

    <div class="toolbar"><button type="button" id="btnAtualizar" class="btn btn-default"><i class="fa fa-refresh"></i></button></div>
</div>


<script src="<?=$url?>public/assets/dist/js/gridall.min.js"></script>
    <script src="<?=$url?>public/assets/dist/js/gridtemplate.js"></script>
    <script src="<?=$url?>public/assets/routes/js/pessoa/gridpessoa.js"></script>

<script>

var gridnamespace = $.namespace("gridtemplatejs");
        
        var colunas = [{
            title: "Codigo",
            field: "id",
            width: 90,
            encoded: true
        }, {
            title: "Codigo personalizado",
            field: "codigopesonalizado",
            width: 190,
            encoded: true
        }, {
            title: "Nome",
            field: "razaosocial",
            encoded: true
        },{
            title: "Tipo",
            field: "descricao",
            width: 80,
            template: '<span class="label label-primary">#=pessoatipo#</span>',
            encoded: true,
        },{
            title: "Relacao",
            field: "descricao",
            width: 200,
            template: '#= gridpessoa.formatarStatus(descricao) #',
            encoded: true,
        },
            gridnamespace.botaoVisualizar()];

        var colunasConfiguracao = {
                    id: {
                        type: "number"
                    },
                    nome: {
                        type: "string"
                    }
                };
                
        gridnamespace.gridtemplate(colunas, colunasConfiguracao);

    $(document).ajaxStart(function () { Pace.restart(); });

    var id = "{{$id or ''}}";

    var recarregarGridTemplate = function(){
        setTimeout(function () {
            if(id == "")
                return false;
                
            if($.isFunction($.gridTemplateValido) && $.gridTemplateValido()){
                var gridTemplate = $("#gridtemplate");
                var gridTemplateGrid = gridTemplate.getKendoGrid();
                gridTemplateGrid.dataSource.read({ 'id': '' + id });
                gridTemplateGrid.bind('dataBinding', function(){
                    setTimeout(function(){
                        if($.obterIdConcluirEdicao() > 0){
                            var grid = gridTemplate;
                            var tr = grid.find("tr");
                            if(tr.length > 1){
                                var classeSelecionada = 'k-state-selected';
                                $(tr[1]).addClass(classeSelecionada);
                            }
                        }
                    }, 250);
                });
                
            }else
                recarregarGridTemplate();
        }, 750)
    }

    recarregarGridTemplate();
</script>
