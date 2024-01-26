<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="product-create-selects-get-started">
            <h1>Product selects</h1>
            <p>
                Product create page, selects option API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="product-create-selects-get-characters">
            <h2><span class="request-method">get</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/product/selects</code>
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
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="product-create-selects-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {

        'status' => true,
        'brand' => [
            'testBrand1',
            'testBrand2',
            'testBrand3',
        ],
        'color' => [
            'testColor1',
            'testColor2',
            'testColor3',
        ],
        'band' => [
            'band1',
            'band2',
            'band3',
        ],
        'dial_type' => [
            'testDialType1',
            'testDialType2',
            'testDialType3',
        ],
        'duration_time' => [
            'testDurationTime1',
            'testDurationTime2',
            'testDurationTime3',
        ],
        'condition' => [
            'new',
            'used',
        ],
        'more_condition' => [
            'papers',
            'box',
            'no paper',
            'no box',
        ],

    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="product-create-selects-errors">
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
