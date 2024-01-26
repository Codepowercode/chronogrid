<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="listings-filter-get-started">
            <h1>listings filter</h1>
            <p>
                Filter listings API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="listings-filter-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/listing</code>
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
                    <td>description</td>
                    <td>String</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>dial</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>dial_markers</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                 <tr>
                    <td>bezel_material</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>bezel_type</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>band_material</td>
                    <td>Array</td>
                    <td><span class="nullable-col">nullable</span></td>
                    <td>empty line</td>
                </tr>
                <tr>
                    <td>band_type</td>
                    <td>Array</td>
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
                    <td>condition</td>
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
            <pre><code class="json" style="float: right; margin-top: -400px;border: 1px solid grey; width: 207px;">
{
  brand: Casio,
  model: 121635483,
  description: 85883215,
  dial: [array],
  dial_markers: [array],
  bezel_material: [array],
  bezel_type: [array],
  band_material: [array],
  band_type: [array],
  metal: 'silver',
  price : [1000, 8000],
  year : [1995, 2005],
  condition : [new, used],
  more_condition : [papers, no box],
  pages: 20,
}
                </code></pre>
        </div>





        <div class="overflow-hidden content-section" id="listings-filter-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        {
            "id": 2048,
            "brand": "Rolex",
            "description": "126301",
            "model": "Datejust",
            "year": null,
            "images": "",
            "count_product": 1,
            "min_price_product": 850
        },
        {
            "id": 2049,
            "brand": "Rolex",
            "description": "126301",
            "model": "Datejust",
            "year": null,
            "images": "",
            "count_product": 0,
            "min_price_product": null
        },
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="listings-filter-errors">
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
