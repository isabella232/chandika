<?
require "autoload.php";
$auth = new Authenticator();

include "header.php";
$expiry_selected = isset($_REQUEST["expiry"]) ? $_REQUEST["expiry"] : "7";
$service_selected = isset($_REQUEST["service"]) ? $_REQUEST["service"] : "";
$resource_type_selected = isset($_REQUEST["resource_type"]) ? $_REQUEST["resource_type"] : "";
$service_admin = new ServiceAdministrator($auth);
$services = ["" => "all"];
foreach ($service_admin->services($auth) as $service) {
    $services[$service->id] = $service->name;
}
$resource_types = ["" => "all"];
foreach (ResourceAdministrator::types() as $resource) {
    $resource_types[$resource] = $resource;
}
?>
<div class="container-fluid">
    <h1>Resources</h1>
    <form action="index.php" method="get">
        Filter by:
        <em>expiry date: <?= Filter::dropdown("expiry", ["7" => "7 days", "30" => "30 days", "365" => "1 year", "" => "all"], $expiry_selected)?></em>
        <em>service: <?= Filter::dropdown("service", $services, $service_selected)?></em>
        <em>resource type: <?= Filter::dropdown("resource_type", $resource_types, $resource_type_selected)?></em>
        <input type="submit" value="Filter">
    </form>
    <table class="table-striped">
        <tr>
            <th>Service</th>
            <th>Account</th>
            <th>Resource type</th>
            <th>URI</th>
            <th>Expiry date</th>
        </tr>
        <?
        foreach (ResourceAdministrator::all($expiry_selected, $service_selected, $resource_type_selected) as $row) {
            $expiry = $row->expires === null ? "None" : gmdate("Y-m-d", $row->expires);
            print "<tr><td><a href='show_resources.php?service_id={$row->service_id}'>{$row->service_name}</a></td><td>{$row->account_label}</td><td>{$row->resource_type}</td><td>{$row->resource_uri}</td><td>$expiry</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>