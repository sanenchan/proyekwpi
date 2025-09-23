<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Plywood Factory</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
            rel="stylesheet"
        />
        <style>
            body,
            html {
                margin: 0;
                padding: 0;
                height: 100%;
                font-family: "Roboto", sans-serif;
            }

            .hero {
                background: linear-gradient(
                        rgba(0, 0, 0, 0.3),
                        rgba(0, 0, 0, 0.3)
                    ),
                    url("https://images.unsplash.com/photo-1581093588401-7d4e2a0c8fae?auto=format&fit=crop&w=1350&q=80")
                        no-repeat center center;
                background-size: cover;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: #fff;
                text-align: center;
            }

            .hero h1 {
                font-size: 3rem;
                margin-bottom: 20px;
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
            }

            .hero p {
                font-size: 1.2rem;
                margin-bottom: 40px;
                max-width: 600px;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
            }

            .button {
                padding: 15px 30px;
                font-size: 1.2rem;
                background-color: #d97706; /* warna kayu hangat */
                color: white;
                text-decoration: none;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                transition: all 0.3s ease;
            }

            .button:hover {
                background-color: #b45309;
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            }

            @media (max-width: 600px) {
                .hero h1 {
                    font-size: 2rem;
                }
                .hero p {
                    font-size: 1rem;
                }
                .button {
                    font-size: 1rem;
                    padding: 12px 25px;
                }
            }
        </style>
    </head>
    <body>
        <div class="hero">
            <h1>Selamat Datang di Plywood Factory</h1>
            <p>
                Mengelola produksi plywood dengan mudah dan efisien. Klik tombol
                di bawah untuk masuk ke halaman admin dan mulai mengatur
                produksi.
            </p>
            <a href="{{ url('/admin') }}" class="button">Masuk Admin</a>
        </div>
    </body>
</html>
