@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{ route('panel') }}" class="bred">
        Home  >
    </a>
    <a href="{{ route('flights.index') }}" class="bred">
        {{ $bred }}
    </a>
</div>

<div class="title-pg">
    <h1 class="title-pg">{{ $title or 'Erro no titulo' }}</h1>
</div>


<div class="content-din bg-white">    

    <div class="form-search">
        {!! Form::open(['route' => 'brands.search', 'class' => 'form form-inline']) !!}
            {!! Form::text('key_search', null, ['class' => 'form-control', 'placeholder' => 'Digite aqui o nome da marca']) !!}

            <button class="btn btn-search">Pesquisar</button>
        {!! Form::close() !!}
    </div>

    @if (isset($searchForm['key_search']))
        <div class="alert alert-info">
            <a href=""><i class="fa fa-refresh" aria-hidden="true"></i></a>
            <p>Resultado para <strong>{{ $searchForm['key_search'] }}</strong></p>
        </div>
    @endif

    <div class="messenges">
        @include('panel.includes.alerts')
    </div>

    <div class="class-btn-insert">
        <a href="{{ route('flights.create') }}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>

    <table class="table table-striped">
        <tr>
            <th>Id</th>
            <th>Origem</th>
            <th>Destino</th>
            <th>Paradas</th>
            <th>Data</th>
            <th>Saída</th>
            <th width="200">Ações</th>
        </tr>

        @forelse ($flights as $flight)
            <tr>
                <td>{{ $flight->id }}</td>
                <td>{{ $flight->airport_origin_id }}</td>
                <td>{{ $flight->airport_destination_id }}</td>
                <td>{{ $flight->qty_stops }}</td>
                <td>{{ $flight->date }}</td>
                <td>{{ $flight->hour_output }}</td>
                <td>
                    <a href="{{ route('flights.edit', $flight->id) }}" class="edit">Editar</a>
                    <a href="{{ route('flights.show', $flight->id) }}" class="delete">Detalhes</a>
                </td>
            </tr>            
        @empty
            <tr>
                <td colspan="200">Nenhum cadastro!</td>
            </tr> 
        @endforelse

    </table>

    {{-- 
    appends = Faz com que o array de pesquisa também vá para a próxima página.

    Se veio a variável $searchForm existir, as informações contidas nela
    são da pesquisa feita pelo input dessa mesma página.
    Caso ela não exista, a paginação deve ser feita normalmente.
    --}}
    @if(isset($searchForm))
        {!! $flights->appends($searchForm)->links() !!}
    @else
        {!! $flights->links() !!}
    @endif

</div><!--Content Dinâmico-->
    
@endsection