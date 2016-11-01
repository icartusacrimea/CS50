<table class="table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($positions))
            {        
                foreach($positions as $position)
                {
                    print("<tr>");
                    print("<td>" . $position["symbol"] . "</td>");
                    print("<td>" . $position["name"] . "</td>");
                    print("<td>" . $position["shares"] . "</td>");
                    print("<td>" . $position["price"] . "</td>");
                    print("</tr>\n");
                }
            }
            
        ?>
        <tr>
            <td colspan="3">Total Cash</td>
            <td>$<?=number_format($users[0]["cash"], 2)?></td>
        </tr>
    </tbody>
</table>