<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Game DB</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container mt-2 mb-4 p-2 shadow bg-white">
      <form action="CRUDquery.php" method="POST">
        <div class="form-row justify-content-center">
          <div class="col-auto">
            <input type="text" name="gamename" class="form-control" id="gamename" placeholder="Nome do Game">
          </div>
          <div class="col-auto">
            <select class="custom-select" name="status" id="status">
              <option selected>Escolher...</option>
              <option value="OK - (Zerei)">OK - (Zerei)</option>
              <option value="Pendente - (Tenho que Zerar)">Pendente - (Tenho que Zerar)</option>
              <option value="Blacklist - (Nunca Jogar)">Blacklist - (Nunca Jogar)</option>
            </select>
          </div>
          <div class="col-auto">
          <button type="submit" name="save" class="btn btn-outline-primary">Salvar</button>
          </div>
        </div>
      </form>
    </div>
    <?php require_once("CRUDquery.php"); ?>
    <div class="container">
      <?php if(isset($_SESSION['msg'])): ?>
      <div class="<?=$_SESSION['alert'];?>">
        <?= $_SESSION['msg'];
        unset($_SESSION['msg']); ?>
      </div>
      <?php endif; ?>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Game</th>
            <th>Status</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <form action="CRUDquery.php" method="POST">
            <?php
            $sQuery = "SELECT * FROM tbl_games LIMIT 20";
            $result = $conn->query($sQuery);
            $x = 1;
            while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><?= $row['gamename']; ?></td>
              <td><?= $row['status']; ?></td>
              <td style="width: 20%">
                <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger">Deletar</button>
                <button type="button" name="edit" value="<?= $x; $x++; ?>" class="btn btn-outline-info">Editar</button>
              </td>
            </tr>
            <?php endwhile; ?>
          </form>
        </tbody>
      </table>
    </div>
    <script type="text/javascript">
      $(document).ready(function()
      {
        setTimeout(function()
        {
          $(".alert").remove();
        }, 3000);
        $(".btn-outline-info").click(function(){
          $(".table").find('tr').eq(this.value).each(function(){
            $("#gamename").val($(this).find('td').eq(1).text());
            $("#status").val($(this).find('td').eq(2).text());
            $(".btn-outline-primary").val($(this).find('td').eq(0).text());
          });
          $(".btn-outline-primary").attr("name","edit");
        });
      })
    </script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
  </body>
</html>