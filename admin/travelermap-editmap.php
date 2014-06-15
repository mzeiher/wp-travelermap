<?php
/**
 *  Copyright (C) 2014 bitschubser.org
 *
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to 
 *  deal in the Software without restriction, including without limitation the
 *  rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 *  sell copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN 
 *  THE SOFTWARE.
 */
?>

<?php
function travelermap_editmap() {
?>

<?php
if(isset($_GET['map_id'])) {
    global $wpdb;
    
    $map_table = $wpdb->prefix . "travelermap_maps";
    $map = $wpdb->get_row(
            $wpdb->prepare(
                    "
                SELECT * FROM $map_table WHERE id = %d
                ", $_GET['map_id']
            )
    );
?>
<script type="text/javascript">
    (function($) {
    $(document).ready(function() {
    window.tm_init();
    window.tm_loadAdminMap('<?php echo $map->map ?>');    
    });
})(jQuery);
</script>
<?php
}   
?>
<div class="tm_mapoptions">
                <input id="travelermap_ajax_getpostnames" type="hidden" value="<?php echo wp_create_nonce('travelermap_ajax_getpostnames') ?>"/>
                <input id="travelermap_ajax_updatemap" type="hidden" value="<?php echo wp_create_nonce('travelermap_ajax_updatemap') ?>"/>
                <input id="travelermap_ajax_getpostinfos" type="hidden" value="<?php echo wp_create_nonce('travelermap_ajax_getpostinfos') ?>"/>
		<label for="tm_map_name">Name</label>
		<input type="text" id="tm_map_name" />
                <input id="tm_map_id" type="hidden" value="<?php echo $map->id ?>" />
		<div class="tm_layer">
			<div class="tm_maplayer">
				<div class="tm_toolbar">
					<select id="tm_layer_select">
						<option value="OpenStreetMap.Mapnik">OpenStreetMap.Mapnik</option>
						<option value="OpenStreetMap.BlackAndWhite">OpenStreetMap.BlackAndWhite</option>
						<option value="OpenStreetMap.DE">OpenStreetMap.DE</option>
						<option value="OpenStreetMap.HOT">OpenStreetMap.HOT</option>
						<option value="Thunderforest.OpenCycleMap">Thunderforest.OpenCycleMap</option>
						<option value="Thunderforest.Transport">Thunderforest.Transport</option>
						<option value="Thunderforest.Landscape">Thunderforest.Landscape</option>
						<option value="Thunderforest.Outdoors">Thunderforest.Outdoors</option>
						<option value="OpenMapSurfer.Roads">OpenMapSurfer.Roads</option>
						<option value="OpenMapSurfer.Grayscale">OpenMapSurfer.Grayscale</option>
						<option value="MapQuestOpen.OSM">MapQuestOpen.OSM</option>
						<option value="MapQuestOpen.Aerial">MapQuestOpen.Aerial</option>
						<option value="Stamen.Toner">Stamen.Toner</option>
						<option value="Stamen.TonerBackground">Stamen.TonerBackground</option>
						<option value="Stamen.Terrain">Stamen.Terrain</option>
						<option value="Stamen.TerrainBackground">Stamen.TerrainBackground</option>
						<option value="Stamen.Watercolor">Stamen.Watercolor</option>
						<option value="Esri.WorldStreetMap">Esri.WorldStreetMap</option>
						<option value="Esri.DeLorme">Esri.DeLorme</option>
						<option value="Esri.WorldTopoMap">Esri.WorldTopoMap</option>
						<option value="Esri.WorldImagery">Esri.WorldImagery</option>
						<option value="Esri.WorldTerrain">Esri.WorldTerrain</option>
						<option value="Esri.WorldShadedRelief">Esri.WorldShadedRelief</option>
						<option value="Esri.WorldPhysica">Esri.WorldPhysica</option>
						<option value="Esri.OceanBasemap">Esri.OceanBasemap</option>
						<option value="Esri.NatGeoWorldMap">Esri.NatGeoWorldMap</option>
						<option value="Esri.WorldGrayCanvas">Esri.WorldGrayCanvas</option>
						<option value="HERE.normalDay">HERE.normalDay</option>
						<option value="HERE.normalDayCustom">HERE.normalDayCustom</option>
						<option value="HERE.normalDayGrey">HERE.normalDayGrey</option>
						<option value="HERE.normalDayMobile">HERE.normalDayMobile</option>
						<option value="HERE.normalDayGreyMobile">HERE.normalDayGreyMobile</option>
						<option value="HERE.normalDayTransit">HERE.normalDayTransit</option>
						<option value="HERE.normalDayTransitMobile">HERE.normalDayTransitMobile</option>
						<option value="HERE.normalNight">HERE.normalNight</option>
						<option value="HERE.normalNightMobile">HERE.normalNightMobile</option>
						<option value="HERE.normalNightGrey">HERE.normalNightGrey</option>
						<option value="HERE.normalNightGreyMobile">HERE.normalNightGreyMobile</option>
						<option value="HERE.carnavDayGrey">HERE.carnavDayGrey</option>
						<option value="HERE.hybridDay">HERE.hybridDay</option>
						<option value="HERE.hybridDayMobile">HERE.hybridDayMobile</option>
						<option value="HERE.pedestrianDay">HERE.pedestrianDay</option>
						<option value="HERE.pedestrianNight">HERE.pedestrianNight</option>
						<option value="HERE.satelliteDay">HERE.satelliteDay</option>
						<option value="HERE.terrainDay">HERE.terrainDay</option>
						<option value="HERE.terrainDayMobile">HERE.terrainDayMobile</option>
						<option value="Acetate.basemap">Acetate.basemap</option>
						<option value="Acetate.terrain">Acetate.terrain</option>
						<option value="Acetate.all">Acetate.all</option>
						<option value="Acetate.hillshading">Acetate.hillshading</option>
					</select>
					<button id="tm_addLayer">AddLayer</button>
				</div>
				<ul id="tm_layerlist">
				</ul>
			</div>
			<div class="tm_overlays">
				<div class="tm_toolbar">
					<select id="tm_overlays_select">
						<option value="OpenMapSurfer.AdminBounds">OpenMapSurfer.AdminBounds</option>
						<option value="Stamen.TonerHybrid">Stamen.TonerHybrid</option>
						<option value="Stamen.TonerLines">Stamen.TonerLines</option>
						<option value="Stamen.TonerLabels">Stamen.TonerLabels</option>
						<option value="OpenWeatherMap.Clouds">OpenWeatherMap.Clouds</option>
						<option value="OpenWeatherMap.CloudsClassic">OpenWeatherMap.CloudsClassic</option>
						<option value="OpenWeatherMap.Precipitation">OpenWeatherMap.Precipitation</option>
						<option value="OpenWeatherMap.PrecipitationClassic">OpenWeatherMap.PrecipitationClassic</option>
						<option value="OpenWeatherMap.Rain">OpenWeatherMap.Rain</option>
						<option value="OpenWeatherMap.RainClassic">OpenWeatherMap.RainClassic</option>
						<option value="OpenWeatherMap.Pressure">OpenWeatherMap.Pressure</option>
						<option value="OpenWeatherMap.PressureContour">OpenWeatherMap.PressureContour</option>
						<option value="OpenWeatherMap.Wind">OpenWeatherMap.Wind</option>
						<option value="OpenWeatherMap.Temperature">OpenWeatherMap.Temperature</option>
						<option value="OpenWeatherMap.Snow">OpenWeatherMap.Snow</option>
						<option value="Acetate.foreground">Acetate.foreground</option>
						<option value="Acetate.roads">Acetate.roads</option>
						<option value="Acetate.labels">Acetate.labels</option>
					</select>
					<button id="tm_addOverlay">AddOverlay</button>
				</div>
				<ul id="tm_overlaylist">
				</ul>
			</div>
		</div>
	</div>
	<div class="tm_pointdetails">
		<div class="tm_form">
                        <input type="hidden" id="tm_postid" value="-1" disabled="true"/>
                        <input type="hidden" id="tm_mediaid" value="-1" disabled="true"/>
			<label for="tm_type">Type</label>
			<select id="tm_type" disabled="true">
				<option value="marker">Marker</option>
				<option value="post">Post</option>
				<option value="media">Media</option>
				<option value="waypoint">Waypoint</option>
				<option value="startsection">Start Section</option>
				<option value="endsection">End Section</option>
			</select><br />
			<label for="tm_title">Title</label>
			<input type="text" id="tm_title" disabled="true"/><br />
			<label for="tm_thumbnail">Thumbnail</label>
			<input type="text" id="tm_thumbnail" disabled="true" /><br />
                        <label for="tm_fullsize">Fullsize</label>
			<input type="text" id="tm_fullsize" disabled="true" /><br />
			<label for="tm_description">Description</label>
			<textarea id="tm_description" disabled="true" ></textarea><br />
			<label for="tm_link">Link</label>
			<input type="text" id="tm_link" disabled="true" /><br />
			<label for="tm_excludefrompath">Exclude From Path</label>
			<input type="checkbox" id="tm_excludefrompath" disabled="true"  /><br />
			<label for="tm_lat">Lat</label>
			<input type="text" id="tm_lat" disabled="true"  /><br />
			<label for="tm_lng">Lng</label>
			<input type="text" id="tm_lng" disabled="true"  /><br />
			<label for="tm_arrival">Arrival</label>
			<input type="text" id="tm_arrival" disabled="true"  /><br />
			<label for="tm_departure">Departure</label>
			<input type="text" id="tm_departure" disabled="true"  /><br />
			<button id="tm_linkToMedia" disabled="true" >Link To Media</button><button id="tm_linkToPost" disabled="true" >Link To Post</button><button id="tm_saveChanges" disabled="true" >Save Changes</button>
		</div>
		<div class="tm_preview_map" style="height: 300px;" id="tm_preview_map" data-mapid="0"></div>
	</div>
	<div class="tm_points">
		<div class="tm_toolbar">
			<button id="tm_addPoint">AddPoint</button><button id="tm_saveMap">Save Map</button><button id="tm_previewMap">Preview Map</button>
		</div>
		<ul id="tm_pointlist">
		</ul>
	</div>
	<textarea id="output"></textarea><button id="tm_loadMap">LoadMap</button>
        
<?php
}
?>
