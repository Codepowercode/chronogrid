<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="products-filter-get-started">
            <h1>products filter</h1>
            <p>
                Filter Products API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="products-filter-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product</code>
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
                    <td>brand</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>model</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>model_number</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>dial_type</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>bezel_type</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>bracelet_type</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>metal</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>condition</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>
                        price [ min max ]
                    </td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>year [ min max ]</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>more_condition</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>pages</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line or product count, default 9 product</td>
                </tr>
                </tbody>
            </table>
<pre><code class="json" style="float: right; margin-top: -460px;border: 1px solid grey; width: 207px;">
<span style="text-align: center;display: block;margin-top: -10px;margin-bottom: -17px;color: #56ff00">['how to send in backend']</span>
<hr>
{
  brand: Casio,
  model_number: 121635483,
  model: 123,
  dial_type: 'blue',
  bezel_type: 'text',
  bracelet_type: 'text',
  metal: 'silver',
  condition: [
           'new',
           'used'
              ],
  price : [1000, 8000],
  year : [1995, 2005],
  more_condition: [
                'box',
                'inbox'
                 ],
  pages: 20,
}
                </code></pre>
        </div>





        <div class="overflow-hidden content-section" id="products-filter-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        {
            "id": 1,
            "company": {
                "id": 1,
                "name": "admin",
                "email": "admin@gmail.com",
                "company": "0",
                "blocked": "0"
            },
            "brand": "Casio",
            "model": "1231",
            "condition": "New",
            "more_condition": "Box",
            "year": "1960",
            "quantity": "2",
            "price": "1500",
            "auction": 0,
            "auction_price": null,
            "auction_min_bid": null,
            "auction_start": null,
            "auction_end": null,
            "status": 1,
            "images": [
                {
                    "id": 6,
                    "product_id": 1,
                    "path": "/storage/product/40a9d3623cc56d9678e73b2940a3f42a.jpg",
                    "status": 0,
                    "created_at": "2022-05-30T13:30:56.000000Z",
                    "updated_at": "2022-05-30T13:30:56.000000Z"
                },
                {
                    "id": 7,
                    "product_id": 1,
                    "path": "/storage/product/062916c4ad0e6897c7792e24c2c477cc.jpg",
                    "status": 0,
                    "created_at": "2022-05-30T13:30:56.000000Z",
                    "updated_at": "2022-05-30T13:30:56.000000Z"
                },
            ]
        },
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="products-filter-errors">
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
