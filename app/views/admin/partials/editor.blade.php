<table class="table">
    <thead>
        <tr>
            <th>Prop</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="(prop, value) in data">
            <td>@{{ prop }}</td>
            <td>@{{ value }}</td>
        </tr>
    </tbody>
</table>