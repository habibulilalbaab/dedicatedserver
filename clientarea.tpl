<table style="width:100%">
    <tr>
        <th>
            <table style="width:90%" class="table table-striped">
                <tr>
                    <td colspan="2">
                        {if $params['id']}
                        <div class="alert alert-success text-center">ONLINE</div>
                    </td>
                    {else}
                    	<div class="alert alert-danger text-center">OFFLINE</div>
                    </td>
                    {/if}
                </tr>
            </table>
        </th>
	</tr>
</table>
