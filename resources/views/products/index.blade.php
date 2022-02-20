<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos cadastrados</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        img {
            max-width: 25%;
            max-height: 25%;
            display: inline-block;
            float: right;
        }
    </style>

</head>
<body>

<div class="container my-5">

    <a href="{{ route("products.create") }}" class="btn btn-success mb-5">Novo Produto</a>

    @if($products->count() === 0)
        <h1>Não existem produtos cadastrados ainda! :/</h1>
    @endif

    @if(!empty($products))
        <section class="articles_list">

            @foreach($products as $product)
                <article class="mb-5">
                    <img align="right" src="{{ asset($product->photo) }}" alt="">
                    <h1>{{ $product->name }}</h1>
                    <h2>{{ $product->sku }}</h2>
                    <p>Estoque: {{ $product->inventory }} itens</p>
                    <p>R$ {{ $product->price }} reais</p>
                    <small>Criado em: {{ date('Y-m-d H:i:s', strtotime($product->created_at)) }} - Editado
                        em: {{ date('Y-m-d H:i:s', strtotime($product->updated_at)) }}</small>

                    <form action="{{ route("products.destroy", ["product" => $product->id]) }}" method="post" class="mt-3">
                        @csrf
                        @method("DELETE")
                        <a href="{{ route("products.edit", ["product" => $product->id]) }}" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </article>
                <hr>
            @endforeach
        </section>
    @endif
</body>
</html>
