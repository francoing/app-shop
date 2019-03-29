<!DOCTYPE html>

<head>
    
    <title>Nuevo pedido</title>
</head>
<body>
    <p>Se ha realizado un nuevo pedido!</p>
    <p>Estos son los datos del cliente que realizo el pedido:</p>
    <ul>
        <li>
            <strong>Nombre:</strong>
            {{$user->name}}
            
        </li>
        <li>
            <strong>E-mail:</strong>
            {{$user->email}}
        </li>
        <li>
            <strong>Fecha del pedido:</strong>
            {{$cart->order_date}}
        </li>
    </ul>
    <p><a href="{{url('/admin/order/'.$cart->id )}}">Haz click aqui</a>
        para ver mas informacion sobre este pedido.
    </p>
    
</body>
</html>