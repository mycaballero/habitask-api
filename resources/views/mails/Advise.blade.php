<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Email</title>
    </head>
    <body>
        <div style="width: 100%; font-family:
                    Inter,
                    -apple-system,
                    BlinkMacSystemFont,
                    'Segoe UI',
                    Roboto,
                    Oxygen,
                    Ubuntu,
                    Cantarell,
                    'Fira Sans',
                    'Droid Sans',
                    'Helvetica Neue',
                    sans-serif;">
            <div style="background-color: #F24855; width: 100%; justify-content: center; display: flex">
                <h1 style="color: #FEF3C7;">Aviso importante </h1>
            </div>
            <p style="color: #000C44; ">
                Hola <span style="font-weight: bold;">
                    {{ $user->name }}
                </span> Tu tarea ha sido colocada en completado.</p>
        </div>
    </body>
</html>
