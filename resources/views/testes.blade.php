<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página com Menu Lateral</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #333;
            color: #fff;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .tabcontent {
            display: none;
        }

        .tabcontent.active {
            display: block;
        }
    </style>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>
<body>

    <div class="sidebar">
        <a href="#" class="tablinks" onclick="openTab(event, 'Gestantes')">Gestantes</a>
        <a href="#" class="tablinks" onclick="openTab(event, 'Obitos')">Óbitos</a>
        <a href="#" class="tablinks" onclick="openTab(event, 'Inconsistencias')">Inconsistências</a>
        <a href="#" class="tablinks" onclick="openTab(event, 'Cadastros')">Cadastros</a>
        <a href="#" class="tablinks" onclick="openTab(event, 'Atendimentos')">Atendimentos CID/CIAP</a>
    </div>

    <div class="content">
        <div id="Gestantes" class="tabcontent">
            <h2>Gestantes</h2>
            <p>Conteúdo sobre gestantes.</p>
        </div>
        <div id="Obitos" class="tabcontent">
            <h2>Óbitos</h2>
            <p>Conteúdo sobre óbitos.</p>
        </div>
        <div id="Inconsistencias" class="tabcontent">
            <h2>Inconsistências</h2>
            <p>Conteúdo sobre inconsistências.</p>
        </div>
        <div id="Cadastros" class="tabcontent">
            <h2>Cadastros</h2>
            <p>Conteúdo sobre cadastros.</p>
        </div>
        <div id="Atendimentos" class="tabcontent">
            <h2>Atendimentos CID/CIAP</h2>
            <p>Conteúdo sobre atendimentos CID/CIAP.</p>
        </div>
    </div>

    <script>
        document.querySelector(".sidebar a").click();
    </script>
</body>
</html>
