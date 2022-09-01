
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">



    <!-- <link rel="stylesheet" href="public/css/index-pdf.css"> -->
<?php
$senderall = $request['sender'];
$sender = $request['sender']['name'];
$sender2 = $request['sender']['document'];
$sender3 = $request['sender']['address'];
$sender4 = $request['sender']['number'];
$sender5 = $request['sender']['postalCode'];
$sender6 = $request['sender']['city'];
$sender7 = $request['sender']['state'];

$reciver = $request['reciver']['name'];
$reciver2 = $request['reciver']['document'];
$reciver3 = $request['reciver']['address'];
$reciver4 = $request['reciver']['number'];
$reciver5 = $request['reciver']['postalCode'];
$reciver6 = $request['reciver']['city'];
$reciver7 = $request['reciver']['state'];

$produtos = $request['content'];
//echo '<pre>';var_dump($senderall);
//echo '</pre>';
?>

<style>
   table, th, td, caption {
            border: 1px solid black;
        }

        table {
            margin: auto;
            border-collapse: collapse;
        }
        

        th, td {
            padding: 10px;
            text-align: center;
            width: 100px;
        }

        th {
            font-weight: bold;
        }
        
    caption {
        font-family: 'Roboto Slab';
        text-align: center;
        font-weight: 300;
        font-size: 20;
        color: white;
        background-color: #cfcdcd !important;
    }
    #div1 {
        display: inline-block;   
    }
    


    </style>
    
</head>
<body>
    <div class=" container row row-cols-12 g-0">

    <div class=" cols s6 id="div1">
       <table id ="table1 " class="bordered striped " >
       <caption>Remetente</caption>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Endereço</th>
                    <th>Cidade/UF</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $sender?></td>
                    <td><?php echo $sender2?></td>
                    <td><?php echo $sender3.' -' .' ' . $sender4 .'<br> '. $sender5 ?></td>
                    <td><?php echo $sender6.'/'.$sender7 ?></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class=" cols s6"> 
       <table class="bordered striped  " >
       <caption>Destinatário</caption>
       <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Endereço</th>
                    <th>Cidade/UF</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $reciver?></td>
                    <td><?php echo $reciver2?></td>
                    <td><?php echo $reciver3.' -' .' ' . $reciver4 .'<br> '. $reciver5 ?></td>
                    <td><?php echo $reciver6.'/'.$reciver7 ?></td>
                </tr>
            </tbody>
        </table>  
    </div>
    <div class="cols-6">
       <table class=" bordered striped  " >
       <caption>Conteúdo</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($produtos as $produto): ?>
                    <td><?php echo $produto['IdProduct']?></td> 
                    <td><?php echo $produto['name']?></td>
                    <td><?php echo $produto['quantity']?></td>
                    <td><?php echo $produto['value']?></td>
                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>
        </div>
    <div class="container">
       <table class="bordered striped  " >
       <caption>Declaração</caption>
        <p>Declaro ainda que não estou postando conteúdo inflamável, explosivo, causador de combustão espontânea, tóxico, corrosivo, gás ou qualquer outro conteúdo que constitua perigo, conforme o art. 13 da Lei Postal nº 6.538/78. Declaro que não me enquadro no conceito de contribuinte previsto no art. 4º da Lei Complementar nº 87/1996, uma vez que não realizo, com habitualidade ou em volume que caracterize intuito comercial, operações de circulação de mercadoria, ainda que se iniciem no exterior, ou estou dispensado da emissão da nota fiscal por força da legislação tributária vigente, responsabilizando-me, nos termos da lei e a quem de direito, por informações inverídicas.</p>
      </div>
    </div>
   
</body>
</html>