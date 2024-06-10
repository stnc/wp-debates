<?php
/*
https://tatvog.wordpress.com/2016/06/22/knockout-js-binding-the-disabled-attribute-in-select-tag/

*/
function  tvsDebate_PushData(){
    $args = [
        "posts_per_page" => - 1, 
        "orderby" => "title", 
        "order" => "asc", 
        "post_type" => "speaker", 
        "post_status" => ["publish", "future", "private"]
     ];
 $posts_array = get_posts($args);
 $initialData_ = array();
 $initialData_["introduction"]= "";
 $initialData_["speakerlist"]= array();
 $initialData_["opinionsStatus"]=array(); 
 if ($posts_array) {
     foreach ($posts_array as $key => $data) {
          $initialData_["speakerlist"][$key]=["name" => $data->post_name,"id" => $data->ID,"selected" => false];
     }
 }
 
$initialData_["opinionsStatus"][0] = ['id' => 1, 'name' => "FOR", 'selected' => false];
$initialData_["opinionsStatus"][1] = ['id' => 2, 'name' => "AGAINST", 'selected' => false];
//  print_r( $initialData_);
//  print_r( json_encode($initialData_));
return  json_encode($initialData_);
}


if (tvsDebate_post_type() ["post_type"] === "debate" || tvsDebate_post_type() ["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_debate_init_metabox");
        add_action("load-post-new.php", "tvsDebate_debate_init_metabox");
    }
}
/*register metabox */
function tvsDebate_debate_init_metabox() {
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_selected_save");
}
function tvsDebate_selected_add_meta_box() {
    add_meta_box("tvs_debate_metabox", __("Speaker", "debateLang"), "tvsDebate_selected_html", "debate", "normal", // normal  side  advanced
    "default");
}





function tvsDebate_selected_html($post) {
    wp_nonce_field("_speaker_selected_nonce", "speaker_selected_nonce"); 

?>

<div id='speakersList'>
    <table class='speakersEditor'>
        <tr>
            <th style="color:red">Select Speaker </th>
            <th style="color:blue"> Introduction </th>
            <th style="color:orange"> Opinions</th>
            <th></th>
        </tr>
        <tbody data-bind="foreach: speakers">
            <tr>
                <td>
                    <select multiple="multiple"    data-bind="foreach: speakerlist ">
                        <option
                            data-bind="value: id, text: name ,attr: { selected : (selected == false) ? selected : '' }  ">
                        </option>
                    </select>


                </td>

                <td>
                    <input class="form-control" id="introduction" data-bind='value: introduction' type="text">
                </td>

                <td>
                    <select data-bind="foreach: opinionsStatus">
                        <option
                            data-bind="value: id, text: name , attr: { selected : (selected == false) ? selected : '' }">
                        </option>
                    </select>
                </td>

                <td>
                    <a href='#' data-bind='click: $root.removeSpeaker'>Delete</a>
                </td>
            </tr>







        </tbody>
    </table>
    <button id="addSpeakerEvent" data-bind='click: addSpeaker'>New Speaker Add</button>
    <button style="display: block" id="SaveJson" data-bind='click: save2, enable: speakers().length > 0'>Save to
        JSON</button>
    <textarea name="tvsDebateMB_selectSpeakerData[]" style="display: block;" data-bind='value: lastSavedJson' rows='5'
        cols='60'> </textarea>
</div>

<a href="#" data-bind="click: function () {setValue(0)}">Set Value to 1</a>

<button data-bind='click: save'>Submit order</button>

<!-- <div data-bind="text: ko.toJSON($root)"></div> -->
<textarea  style="display: block;" data-bind="text: ko.toJSON($root)" rows='5'
        cols='60'> </textarea>

<script type="text/javascript">
jQuery("#publish").click(function() {
    jQuery("#SaveJson").click();
});

// jQuery(document).ready(function() {
//     jQuery('.speakerlist').on('change', function() {

//         jQuery(".speakerlist :selected" ).attr('selected','selected');
//         // jQuery(".speakerlist :selected" ).removeAttr('selected');
//         alert (   jQuery(".speakerlist :selected").val());
//     });
// });


var CartLine = function() {
    var self = this;
    self.category = ko.observable();
    self.product = ko.observable();
    self.quantity = ko.observable(1);

 
    // Whenever the category changes, reset the product selection
    self.category.subscribe(function() {
        self.product(undefined);
    });
};

var speakersModel = function(speakers) {
    var self = this;


    self.speakers = ko.observableArray(ko.utils.arrayMap(speakers, function(speaker) {
        return {
            introduction: speaker.introduction,
            opinionsStatus: ko.observableArray(speaker.opinionsStatus),
            speakerlist: ko.observableArray(speaker.speakerlist)
        };
    }));

    self.save = function() {
        var dataToSave = jQuery.map(self.lines(), function(line) {
            return line.product() ? {
                productName: line.product().name,
                quantity: line.quantity()
            } : undefined
        });
        alert("Could now send this to server: " + JSON.stringify(dataToSave));
    };


    self.addSpeaker = function() {
        self.speakers.push(<?php echo tvsDebate_PushData() ?>);
    };

    self.removeSpeaker = function(speaker) {
        self.speakers.remove(speaker);
    };



    // https://jsfiddle.net/xjYcu/276/

    // permissionChanged= function(obj, event){
    //     console.log(event.target.value);
    //     // console.log(event.target.value);
    //     jQuery("#speakerlist").attr('selected','selected');
    // };


    // permissionChanged= function(element, value){
    //     // var value = ko.utils.unwrapObservable(valueAccessor());
    //     if (!value && element.selected)
    //         element.selected = false;
    //     else if (value && !element.selected)
    //         element.selected = true;

    // };

    // this.permissionChanged = function(obj, event) {
    //     if (event.originalEvent) { //user changed
    //         // alert("dd");
    //         event.selected = true;
    //     } else { // program changed
    //     }
    // };


    // ko.bindingHandlers.checkedRadioToBool = {
    //     init: function(element, valueAccessor, allBindingsAccessor) {
    //         var observable = valueAccessor(),
    //             interceptor = ko.computed({
    //                 read: function() {
    //                     return observable().toString();
    //                 },
    //                 write: function(newValue) {
    //                     observable(newValue === "true");
    //                 },
    //                 owner: this
    //             });
    //         ko.applyBindingsToNode(element, {
    //             checked: interceptor
    //         });
    //     }
    // };


    self.save2 = function() {
        self.lastSavedJson(JSON.stringify(ko.toJS(self.speakers), null, 2));
    };

    self.lastSavedJson = ko.observable("")
};


var initialData = [{
        introduction: "Danny",
        opinionsStatus: [{
                id: 1,
                name: "FOR",
                selected: false
            },
            {
                id: 2,
                name: "AGAINST",
                selected: true
            }
        ],
        speakerlist: [{
                id: 1,
                name: "Apple",
                selected: false
            },
            {
                id: 55,
                name: "Orange",
                selected: false
            },
            {
                id: 78,
                name: "vegas",
                selected: true
            },
            {
                id: 3,
                name: "Banana",
                selected: false
            }
        ]
    },
    {
        introduction: "Danny33",
        opinionsStatus: [{
                id: 1,
                name: "FOR",
                selected: true
            },
            {
                id: 2,
                name: "AGAINST",
                selected: false
            }
        ],
        speakerlist: [{
                id: 1,
                name: "Apple",
                selected: false
            },
            {
                id: 55,
                name: "Orange",
                selected: true
            },
            {
                id: 78,
                name: "vegas",
                selected: false
            },
            {
                id: 3,
                name: "Banana",
                selected: false
            }
        ]
    }
];




ko.applyBindings(new speakersModel(initialData));
</script>


<?php
}
/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/
function tvsDebate_selected_get_meta_simple($value) {
    global $post;
    return get_post_meta($post->ID, $value, true);
}
function tvsDebate_selected_save($post_id) {
    if (wp_is_post_autosave($post_id)) {
        return;
    }
    // Check if not a revision.
    if (wp_is_post_revision($post_id)) {
        return;
    }
    // Stop the script when doing autosave
    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (isset($_POST["tvsDebateMB_selectSpeakerData"])) {
        $selectedOptionlist_locations = implode(",", $_POST["tvsDebateMB_selectSpeakerData"]);
        update_post_meta($post_id, "tvsDebateMB_selectSpeakerData", sanitize_text_field($selectedOptionlist_locations));
    }
}