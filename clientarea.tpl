{$params['serviceid']}
{if $statusNoVNC == NULL}
<div class="alert alert-danger text-center">NoVNC Offline</div>
{else}
<div class="alert alert-success text-center">NoVNC Online</div>
<table style="width:100%">
    <tr>
        <td><b>NoVNC User:</b></td>
        <td>{$notesLines[3]}</td>
    </tr>

    <tr>
        <td><b>NoVNC Password:</b></td>
        <td>{$notesLines[4]}</td>
    </tr>

    <tr>
        <td><b>VNC Password:</b></td>
        <td>{$notesLines[2]}</td>
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
    document.getElementById("novncurl").innerHTML = "https://'.$userpass.'" + window.location.host + ":" +'.$port.' + "/vnc.html";

    function runNoVNC() {
        window.open("https://'.$userpass.'" + window.location.host + ":" + '.$port.' + "/vnc.html");
    }
</script>
{/if}