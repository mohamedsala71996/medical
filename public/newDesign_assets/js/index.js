/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
let goal = document.querySelector('.property::after');
async function initMap() {
    // Request needed libraries.

    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    const center = { lat: 37.43238031167444, lng: -122.16795397128632 };

    const map = new Map(document.getElementById("map"), {
        zoom: 11,
        center,
        mapId: "4504f8b37365c3d0",
    });
    for (const property of properties) {
        const AdvancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
            map,
            content: buildContent(property),
            position: property.position,
            title: property.description,
        });

        if (property.type === "doctor") {
            AdvancedMarkerElement.zindex = -9999
        } else if (property.type === "nolg") {
            AdvancedMarkerElement.zindex = -9999
        }
        AdvancedMarkerElement.addListener("click", () => {
            
            toggleHighlight(AdvancedMarkerElement, property);
        });
        AdvancedMarkerElement.addListener("click", () => {
            togglebinkHighlight(AdvancedMarkerElement, property);
        });
    }
}


function toggleHighlight(markerView, property) {
    if (property.type === "nolg") {
        if (markerView.content.classList.contains("highlight")) {
            markerView.content.classList.remove("highlight");
            markerView.zIndex = null;
        } else {
            markerView.content.classList.add("highlight");
            markerView.zIndex = 1;
        }
    }
}

function togglebinkHighlight(markerView, property) {
    if (property.type === "doctor") {
        if (markerView.content.classList.contains("bink")) {
            markerView.content.classList.remove("bink");
            markerView.zIndex = null;
        } else {
            markerView.content.classList.add("bink");
            markerView.zIndex = 1;
        }
    }
}



function buildContent(property) {
    const content = document.createElement("div");
    content.classList.add("property");
      
    content.innerHTML = `
      <div class="details" id="srs-m">
      <div class="card">
      
      <ul>
      
        <li class="my-1 li-move "><i class="fa-solid fa-user col-i" ></i>   mai ahmed ali <img aria-hidden="true" src="./images/per.png"> <br/> <div class="stars">
        <span class="star"><i class="fa-solid fa-star"></i></span>
        <span class="star"><i class="fa-solid fa-star"></i></span>
        <span class="star"><i class="fa-solid fa-star"></i></span>
        <span class="star"><i class="fa-solid fa-star"></i></span>
        <span class="star"><i class="fa-solid fa-star"></i></span>
      </div></li>
        <li class="my-1"><i class="fa-solid fa-phone col-i"></i> +201200065604</li>
        <li class="my-1"><i class="fa-solid fa-location-dot col-i"></i>   Mansoura , cairo</li>
        <li class="my-1"><i class="fa-solid fa-clock col-i"></i> Avaliable  from 10 am to 9 pm</li>
      </ul>
      </div>
      </div>
     
      `;
    return content;

}

const properties = [
    {
        type: "doctor",
        position: {
            lat: 37.50024109655184,
            lng: -122.28528451834352,
        },
    },
    {
        type: "doctor",
        position: {
            lat: 37.44440882321596,
            lng: -122.2160620727,
        },
    },
    {
        type: "nolg",
        position: {
            lat: 37.39561833718522,
            lng: -122.21855116258479,
        },
    },
    {
        type: "doctor",
        position: {
            lat: 37.423928529779644,
            lng: -122.1087629822001,
        },
    },
    {
        type: "doctor",
        position: {
            lat: 37.40578635332598,
            lng: -122.15043378466069,
        },
    },
    {
        type: "doctor",
        position: {
            lat: 37.36399747905774,
            lng: -122.10465384268522,
        },
    },
    {
        type: "nolg",
        position: {
            lat: 37.38343706184458,
            lng: -122.02340436985183,
        },
    },
    {
        type: "nolg",
        position: {
            lat: 37.34576403052,
            lng: -122.04455090047453,
        },
    },
    {
        type: "nolg",
        position: {
            lat: 37.362863347890716,
            lng: -121.97802139023555,
        },
    },
    {
        type: "nolg",
        position: {
            lat: 37.41391636421949,
            lng: -121.94592071575907,
        },
    },
];

initMap();
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -33.8688, lng: 151.2195 },
        zoom: 13,
        mapTypeId: "roadmap",
    });
    // Create the search box and link it to the UI element.
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            // Create a marker for each place.
            markers.push(
                new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                }),
            );
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

window.initAutocomplete = initAutocomplete;


