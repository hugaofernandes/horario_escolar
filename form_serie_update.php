
<?php
    include "templates.php";
    $serie = $_GET['serie'];
    require_once "conexao.php";
    $resultado_sigla = mysql_query("SELECT * FROM disciplinas ORDER BY 'sigla_disciplina'");
?>

  <body>
        <form method="post" action="dao_serie/update_serie.php">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Série</h1>
        	 <div class="form-group">
        		<label for="exampleInputEmail1">Série</label>
        		<input type="text" class="form-control" name="serie" value="<?php echo htmlspecialchars($serie);?>" style='background: #EEE; cursor: not-allowed; color: #777' readonly>
        </div>

          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <script type="text/javascript">
          $(document).ready(function(){
              var maxField = 20; //Input fields increment limitation
              var addButton = $('.btn-primary'); //Add button selector
              var wrapper = $('.field_wrapper'); //Input field wrapper
              var fieldHTML = '<div><br><div class="col-xs-5"><select name="sigla_disciplina[]" id="ex3" class="select form-control"><option value="" disabled selected>Selecione uma Sigla de Disciplina</option><?php while($linhas = mysql_fetch_array($resultado_sigla)){ $siglaList = $linhas['sigla_disciplina']; echo '<option value="'.$siglaList.'">'.$siglaList.'</option>';}?></select></div><div class="col-xs-6"><input type="number" class="form-control" id="ex4" name="aulasPorDisciplina[]" placeholder="Informe a quantidade de Aulas dessa Disciplina"></div><div class="col-xs-1"></div><a href="javascript:void(0);" id="ex5" type="button" class="btn btn-danger" title="Remove field"><span class="glyphicon glyphicon-minus"></span></a></div>'; //New input field html
              var x = 1; //Initial field counter is 1
              $(addButton).click(function(){ //Once add button is clicked
                  if(x < maxField){ //Check maximum number of input fields
                      x++; //Increment field counter
                      $(wrapper).append(fieldHTML); // Add field html
                  }
              });
              $(wrapper).on('click', '.btn-danger', function(e){ //Once remove button is clicked
                  e.preventDefault();
                  $(this).parent('div').remove(); //Remove field html
                  x--; //Decrement field counter
              });
          });
          </script>
          
        <div class="form-group">
          <div class="col-xs-5">
            <label for="ex3">Sigla da Disciplina</label>
          </div>
          <div class="col-xs-6">
            <label for="ex4">Quantidade de Aulas na Semana desta Disciplina</label>
          </div>
          <div class="col-xs-1">
            <label for="ex5"></label>
          </div>
          <div class="field_wrapper">
            <div>
              <br>
              <div class="col-xs-5">
                  <select name="sigla_disciplina[]" id="ex3" class="select form-control">
                    <option value="" disabled selected>Selecione uma Sigla de Disciplina</option>
                    <?php
                      while($linhas = mysql_fetch_array($resultado_sigla)){
                        $siglaList = $linhas['sigla_disciplina'];
                        echo '<option value="'.$siglaList.'">'.$siglaList.'</option>';
                      }
                    ?>
                  </select>
              </div>
              <div class="col-xs-6">
                  <input type="number" class="form-control" id='ex4' name="aulasPorDisciplina[]" placeholder="Informe a quantidade de Aulas dessa Disciplina"><br>
              </div>
              <div class="col-xs-1">
              </div>
                  <a href="javascript:void(0);" id='ex5' type='button' class='btn btn-primary' title="Add field"><span class='glyphicon glyphicon-plus'></span></a>
            </div>
          </div>
          <br>
        </div>

            <button type="submit" class="btn btn-info">Salvar</button>
            <button class="btn btn-danger" type="reset">Limpar</button>
        
        </div>
        </form>
</body>