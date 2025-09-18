<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>403 Forbidden - Akses Ditolak</title>

    <style>
        body {
            height: 100%;
            background: #fafafa;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #777;
            font-weight: 300;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .wrap {
            max-width: 600px;
            margin: 5rem auto;
            padding: 2rem;
            background: #fff;
            text-align: center;
            border: 1px solid #efefef;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-weight: bold;
            font-size: 5rem;
            margin: 0;
            color: #dd4814;
        }

        h2 {
            margin-top: 0.5rem;
            font-weight: 400;
            color: #444;
        }

        p {
            margin-top: 1.5rem;
            font-size: 1.125rem;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.85rem;
            color: #999;
        }

        a {
            color: #dd4814;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <h1>403</h1>
        <h2>Akses Ditolak</h2>
        <p>
            <?php if (ENVIRONMENT !== 'production' && isset($message)) : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                Anda tidak memiliki izin untuk mengakses halaman ini.
            <?php endif; ?>
        </p>
        <p><a href="<?= site_url() ?>">Kembali ke Beranda</a></p>
        <div class="footer">
            &copy; <?= date('Y') ?> SISPANDALWAS
        </div>
    </div>
</body>

</html>