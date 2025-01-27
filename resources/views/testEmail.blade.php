<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->title }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px; padding: 20px; background-color: #f9f9f9;">
        <h1 style="color: #0056b3;">{{ $data->title }}</h1>
        <p>{{ $data->body }}</p>
        <p style="font-weight: bold;">Seu token de redefinição:</p>
        <p style="font-size: 1.2em; color: #d9534f;">{{ $data->link }}</p>
        <p>Clique no botão abaixo para redefinir sua senha:</p>
        <a href="{{ $data->link }}" 
           style="display: inline-block; padding: 10px 15px; background-color: #0056b3; color: #fff; text-decoration: none; border-radius: 5px;">
           Redefinir Senha
        </a>
        <p style="margin-top: 20px; font-size: 0.9em; color: #666;">Se você não solicitou a redefinição de senha, ignore este e-mail.</p>
    </div>
</body>
</html>
