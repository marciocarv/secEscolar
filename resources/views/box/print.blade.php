<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style cellspancing="0">
        table{
            border-collapse: collapse;
        }
        table td{
            border: 1px solid black;
            padding: 3px;
        }
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="4" class="center">
                <h1>Caixa {{$box->description}}</h1>
            </td>
        </tr>
        <tr>
            <td class="center">Nº</td>
            <td>Nome</td>
            <td>Data de Nascimento</td>
            <td>Situação</td>
        </tr>
    @foreach($bonds as $bond)
        <tr>
            <td class="center">
               {{$loop->index + 1}}
            </td>
            @if($box->type != 'Servidor')
            <td>{{$bond->student->name}}</td>
            <td>{{$bond->student->date_birth->format('d/m/Y')}}</td>
            @else
            <td>{{$bond->employee->name}}</td>
            <td>{{$bond->employee->date_birth->format('d/m/Y')}}</td>
            @endif
            <td>{{$bond->status}}</td>
        </tr>    
    @endforeach
    </table>
</body>
</html>