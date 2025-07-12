<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asociados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10mm; /* Márgenes reducidos */
            color: #333;
        }
        .header {
            display: flex;
            justify-content: flex-end; /* Logo a la derecha */
            margin-bottom: 10px;
        }
        .logo img {
            max-width: 200px; /* Logo grande */
            height: auto;
        }
        h1 {
            text-align: left; /* Título alineado a la izquierda */
            color: #1a73e8;
            font-size: 20px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Fuente compacta */
        }
        th, td {
            border: 1px solid #999; /* Bordes de cuadrícula */
            padding: 6px; /* Espaciado reducido */
            text-align: left;
        }
        th {
            background-color: #e0e0e0; /* Encabezado gris */
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f5f5f5; /* Filas alternadas */
        }
        .footer {
            text-align: left; /* Pie de página a la izquierda */
            margin-top: 15px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('image/logo_Jass.jpg') }}" alt="Logo">
        </div>
    </div>
    <h1>Reporte de Asociados</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Dirección</th>
                <th>Registro de Vivienda</th>
                <th>Estado</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($associates as $index => $associate)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Str::limit($associate->name, 20) }}</td>
                    <td>{{ Str::limit($associate->last_name, 20) }}</td>
                    <td>{{ Str::limit($associate->dni, 20) }}</td>
                    <td>{{ Str::limit($associate->address_house, 50) }}</td>
                    <td>{{ Str::limit($associate->housing_registration, 50) }}</td>
                    <td>{{ $associate->status ? 'Activo' : 'Inactivo' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Generado el {{ now()->format('d/m/Y H:i') }} | Sistema de Control de JASS para la Gestión de Asociados
    </div>
</body>
</html>
