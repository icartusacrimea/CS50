<table class="table table-striped">
    <thead>
        <tr>
            <th>Transaction Type</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Date and Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($table as $table)
            {
                print("<tr>");
                print("<td>" . $table["transaction"] . "</td>");
                print("<td>" . $table["symbol"] . "</td>");
                print("<td>" . $table["shares"] . "</td>");
                print("<td>" . money_format("$%i", $table["price"]) . "</td>");
                print("<td>" . $table["time"] . "</td>");
                print("</tr>\n");
            }
            
        ?>
    </tbody>
</table>