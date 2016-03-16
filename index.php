<!DOCTYPE html>
<html lang="en">
  <?php
  $client = new SoapClient('https://joaopaulo-pu401lac:8181/LivrariaWebService/LivroManagerBean?wsdl');


$arguments = null;
  if(isset($_GET['funcao']) && isset($_GET['valor'])){
    $v = $_GET['valor'];
      switch($_GET['funcao']){
        case 'titulo':
          $function = 'consultarPorTitulo';
          $arguments= array('parameters'=>array('titulo'=>$v));
          break;
        case 'isbn':
          $function = 'consultarPorIsbn';
          $arguments= array('parameters'=>array('isbn'=>$v));
          break;
        case 'autor':
          $function = 'consultarPorAutor';
          $arguments= array('parameters'=>array('autor'=>$v));
          break;
        default:
          $function = 'getTodosOsLivros';
          $arguments= array();
      }
  }else{
      $function = 'getTodosOsLivros';
      $arguments= array();
  }

  $result = $client->__soapCall($function, $arguments);
  $countConsultas = $client->__soapCall('numeroBuscas', array());

  ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>LivrariaRemot4</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Livraria Remot4</a>

          </div>
          <p class="navbar-text navbar-right">Consultas: <?php echo $countConsultas->return; ?>  </p>
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->


    </div> <!-- /container -->
    <div class="row">
      <div class="col-md-2 col-md-offset-1">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">
         <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
      </button>
    </div>
    </div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="modalConsultaLabel">

  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalConsultaLabel">Consultar</h4>
      </div>
      <br/>
      <form method="GET" action="index.php">
          <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <input type="text" name="valor" class="form-control" placeholder="Palavra-chave">
          </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <label class="radio-inline">
              <input type="radio" name="funcao" id="inlineRadio1" value="titulo"> Título
            </label>
            <label class="radio-inline">
              <input type="radio" name="funcao" id="inlineRadio2" value="isbn"> ISBN
            </label>
            <label class="radio-inline">
              <input type="radio" name="funcao" id="inlineRadio3" value="autor"> Autor
            </label>
          </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-md-6 col-md-offset-4">
            <input class="btn btn-primary" type="submit" value="Confirmar">
          </div>
          </div>
        </form>
        <br/><br/>
    </div>
  </div>
</div>

      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <table class="table table-striped">
            <tr>
              <th>Titulo</th>
              <th>Editora</th>
              <th>ISBN</th>
              <th>Edicao</th>
              <th>Autor</th>
            </tr>
          <?php
          if(!is_array($result->return)){
            echo '<tr>';
            echo '<td>'.$result->return->titulo.'</td>';
            echo '<td>'.$result->return->editora.'</td>';
            echo '<td>'.$result->return->isbn.'</td>';
            echo '<td>'.$result->return->edicao.'</td>';
            echo '<td>'.$result->return->autor.'</td>';
            echo '</tr>';
          }else{
            foreach ($result->return as $livro) {
              echo '<tr>';
              echo '<td>'.$livro->titulo.'</td>';
              echo '<td>'.$livro->editora.'</td>';
              echo '<td>'.$livro->isbn.'</td>';
              echo '<td>'.$livro->edicao.'</td>';
              echo '<td>'.$livro->autor.'</td>';
              echo '</tr>';
            }
          }
          ?>
        </table>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
