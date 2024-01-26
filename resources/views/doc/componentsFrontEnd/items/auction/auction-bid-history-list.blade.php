<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="auction-bid-history-list-get-started">
            <h1>auction bid history list</h1>
            <p>
                Auction bidded history list of the given product API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="auction-bid-history-list-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/auction/list/history/{id}</code>
            </p>
            <br>
            <h4>QUERY PARAMETERS</h4>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Importance</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>access_token</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Your API access key. (header)</td>
                </tr>
                <tr>
                    <td>id</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Product id in url</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="auction-bid-history-list-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <p>According to the status private/public</p>
            <pre><code class="json" style="border:1px solid grey">
    {
      id: 1,
      company: " ",
      product_id: "10",
      price: 1600,
      status: "private",
    }
                </code></pre>
            <pre><code class="json" style="border:1px solid grey">
    {
      id: 1,
      "company": {
          "id": 1,
          "name": "admin",
          "email": "admin@gmail.com",
          "company": "0",
          "blocked": "0"
      },
      product_id: "10",
      price: 1600,
      status: "public",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="auction-bid-history-list-errors">
            <h2>Errors</h2>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
