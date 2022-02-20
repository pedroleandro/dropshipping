<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container my-5">

    <a href="{{ route("products.index") }}" class="btn btn-success mb-5">Lista de Produtos</a>

    <form action="{{ route("products.update", ['product' => $product->id]) }}" method="post">

        @csrf
        @method("PUT")

        <div class="form-group">
            <label for="name">Nome do produto</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}">
        </div>

        <div class="form-group">
            <label for="inventory">Estoque</label>
            <input type="number" name="inventory" id="inventory" class="form-control" value="{{ $product->inventory }}">
        </div>

        <div class="form-group">
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" class="form-control price" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label for="photo">Foto do produto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-primary">Atualizar Produto</button>
    </form>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>

<script>
    $(function () {
        $(".price").mask('R$ 000.000.000.000.000,00', {reverse: true, placeholder: "R$ 0,00"});
    });
</script>
</body>
</html>
