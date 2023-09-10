{if $statusNoVNC != true}
<div class="alert alert-danger text-center">NoVNC Offline</div>
<table style="width:100%">
    <tr>
        <td><b>NoVNC User:</b></td>
        <td>{if $notesLines[3]}{$notesLines[3]}{else}-{/if}</td>
    </tr>

    <tr>
        <td><b>NoVNC Password:</b></td>
        <td>{if $notesLines[4]}{$notesLines[4]}{else}-{/if}</td>
    </tr>

    <tr>
        <td><b>VNC Password:</b></td>
        <td>{if $notesLines[2]}{$notesLines[2]}{else}-{/if}</td>
    </tr>
</table>
{else}
<div class="alert alert-success text-center">NoVNC Online</div>
<table style="width:100%">
    <tr>
        <td><b>NoVNC User:</b></td>
        <td>{if $notesLines[3]}{$notesLines[3]}{else}-{/if}</td>
    </tr>

    <tr>
        <td><b>NoVNC Password:</b></td>
        <td>{if $notesLines[4]}{$notesLines[4]}{else}-{/if}</td>
    </tr>

    <tr>
        <td><b>VNC Password:</b></td>
        <td>{if $notesLines[2]}{$notesLines[2]}{else}-{/if}</td>
    </tr>

    <tr>
        <td><b>NoVNC URL:</b></td>
        <td id="novncurl"></td>
    </tr>

    <tr>
        <td><b>NoVNC Access:</b></td>
        <td><button onclick="runNoVNC()" type="button" class="btn btn-primary">NoVNC Console</button></td>
    </tr>

</table>
<script>
    document.getElementById("novncurl").innerHTML = "https://{if $userpass}{$userpass}{else}{/if}" + window.location.host + ":" +'{if $port}{$port}{else}{/if}' + "/vnc.html";

    function runNoVNC() {
        window.open("https://{if $userpass}{$userpass}{else}{/if}" + window.location.host + ":" + '{if $port}{$port}{else}{/if}' + "/vnc.html");
    }
</script>
{/if}
<button id="createServerBtn">Create Server</button>

<script>
    document.getElementById('createServerBtn').addEventListener('click', function() {
        // Mengirim permintaan untuk membuat server dedikasi
        // Pastikan untuk menyesuaikan URL dan parameter jika diperlukan
        fetch('modules/servers/dedicatedserver/dedicatedserver.php', {
            method: 'POST',
            body: JSON.stringify({ action: 'create' }), // Mengirimkan tindakan 'create'
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Menangani respons dari server jika diperlukan
            console.log(data);
        })
        .catch(error => console.error('Error:', error));
    });
</script>
