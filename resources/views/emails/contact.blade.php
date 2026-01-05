<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yeni İletişim Formu Mesajı</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1F2937; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #1F2937; }
        .value { margin-top: 5px; }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LOG Makine A.Ş.</h1>
            <p>Yeni İletişim Formu Mesajı</p>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">Ad Soyad:</div>
                <div class="value">{{ $data['name'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">E-posta:</div>
                <div class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></div>
            </div>
            
            @if(!empty($data['phone']))
            <div class="field">
                <div class="label">Telefon:</div>
                <div class="value">{{ $data['phone'] }}</div>
            </div>
            @endif
            
            <div class="field">
                <div class="label">Konu:</div>
                <div class="value">{{ $data['subject'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Mesaj:</div>
                <div class="value">{!! nl2br(e($data['message'])) !!}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>Bu e-posta LOG Makine A.Ş. web sitesi iletişim formu üzerinden gönderilmiştir.</p>
            <p>© {{ date('Y') }} LOG Makine A.Ş. Tüm hakları saklıdır.</p>
        </div>
    </div>
</body>
</html>
