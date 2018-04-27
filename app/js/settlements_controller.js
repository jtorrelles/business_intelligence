
var setCityId = 0; 
var setStateId = 0;
var setCountryId = 0;
var setShowID = 0;
var setVenueID = 0;

function ajaxCall() {
    this.send = function(data, url, method, success, type) {
        type = type||'json';

    var successRes = function(data) {
        success(data);
    };

    var errorRes = function(e) {
        alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
    };

    $.ajax({
        url: url,
        type: method,
        data: data,
        success: successRes,
        error: errorRes,
        dataType: type,
        timeout: 60000
    });

    }
};

function ajaxCallUpload() {
    this.sendUpload = function(data, url, method, success, type) {
        type = type||'json';

    var successResUpload = function(data) {
        success(data);
    };

    var errorResUpload = function(e) {
        alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
    };

    $.ajax({
        url: url,
        type: method,
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        success: successResUpload,
        error: errorResUpload,
        dataType: type,
        cache: false,
        timeout: 60000000
    });

    }
};

function getCountries() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getCountries';
    var method = "GET";
    var data = {};
    $('.countries').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.countries').find("option:eq(0)").html("Select Country");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.countries').append(option);
            });
            $(".countries").prop("disabled",false);

            //set country value
            if(setCountryId != 0){
                $(".countries").val(setCountryId);
            }else{
                //Sel United States
                $(".countries").val("231");
                getStates(231);
            }

        }
        else{
            alert(data.msg);
        }
    }); 
}

function getStates(id) {
    var call = new ajaxCall();
    $(".states option:gt(0)").remove(); 
    $(".cities option:gt(0)").remove();
    var url = '../routes/settlements_route.php?type=getStates&countryId=' + id;
    var method = "GET";
    var data = {};
    $('.states').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.states').find("option:eq(0)").html("Select State");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.states').append(option);
            });
            $(".states").prop("disabled",false);

            //set states value
            if(setStateId != 0){ 
                $(".states").val(setStateId);
            }
            
        }
        else{
            alert(data.msg);
        }
    }); 
}

function getCities(id) {
    var call = new ajaxCall();
    $(".cities option:gt(0)").remove();
    var url = '../routes/settlements_route.php?type=getCities&stateId=' + id;
    var method = "GET";
    var data = {};
    $('.cities').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.cities').find("option:eq(0)").html("Select City");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.cities').append(option);
            });
            $(".cities").prop("disabled",false);

            //set city value
            if(setCityId != 0){
                $(".cities").val(setCityId);
            }
        }
        else{
             alert(data.msg);
        }
    });
}

function getGlobalLocation(cityID) {
    if(cityID != 0){
        var call = new ajaxCall();
        var url = '../routes/settlements_route.php?type=getGlobalLocation&cityId=' + cityID;
        var method = "GET";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data.tp == 1){

                console.log(data);

                setCityId = data["result"].cityid;
                setStateId = data["result"].stateid;
                setCountryId = data["result"].countryid;

                getCities(data["result"].stateid);
                getStates(data["result"].countryid);
                getCountries();
            }
            else{
                 alert(data.msg);
            }
        });
    }else{
        getCountries();
    }

}

function getShows() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getShows';
    var method = "GET";
    var data = {};
    $('.shows').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.shows').find("option:eq(0)").html("Select Show");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.shows').append(option);
            });
            $(".shows").prop("disabled",false);

            //set venue value
            if(setShowID != 0){ 
                $(".shows").val(setShowID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
}

function getVenues() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getVenues';
    var method = "GET";
    var data = {};
    $('.venues').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.venues').find("option:eq(0)").html("Select Venues");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', key).text(val);
                $('.venues').append(option);
            });
            $(".venues").prop("disabled",false);

            //set venue value
            if(setVenueID != 0){ 
                $(".venues").val(setVenueID);
            }
        }
        else{
            alert(data.msg);
        }
    }); 
}

function getCityOfVenues(venueId) {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getCityOfVenues&venueId=' + venueId;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){
            var city = data['result'].cityname;
            var state = data['result'].statename;
            var cityid = data['result'].cityid;

            $(".cityname").prop("value",city);
            $(".statename").prop("value",state);
            $(".cityid").prop("value",cityid);
            
            $(".cityname").prop("disabled",true);
            $(".statename").prop("disabled",true);
        }
        else{
            alert(data.msg);
        }
    }); 
}

function findData(id){
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getData&settlementId=' + id;
    var method = "GET";
    var data = {};
    call.send(data, url, method, function(data) {
        if(data.tp == 1){

            $('.id').val(data['result'].se_1);
            $('.show_name').val(data['result'].se_3);
            $('.venue_name').val(data['result'].se_5);

            $('.opening_date').val(data['result'].se_6);
            $('.closing_date').val(data['result'].se_7);
            $('.drop_count').val(data['result'].se_8);
            $('.paid_attendance').val(data['result'].se_9);
            $('.comps').val(data['result'].se_10);
            $(".total_attendance").val(data['result'].se_11);
            $('.capacity').val(data['result'].se_12);
            $('.internet_sales').val(data['result'].se_13);
            $('.credit_card_sales').val(data['result'].se_14);
            $('.remote_outlet_sales').val(data['result'].se_15);
            $('.single_tix').val(data['result'].se_16);
            $('.group_sales_1').val(data['result'].se_17);
            $('.group_sales_2').val(data['result'].se_18);
            $(".goldstar").val(data['result'].se_19);
            $('.groupon').val(data['result'].se_20);
            $('.traveloo').val(data['result'].se_21);
            $('.living_social').val(data['result'].se_22);
            $('.other_percentage').val(data['result'].se_23);
            $('.other_amount').val(data['result'].se_24);
            $('.sub_discount').val(data['result'].se_25);
            $('.group1_discount').val(data['result'].se_26);
            $('.group2_discount').val(data['result'].se_27);
            $(".total_discount").val(data['result'].se_28);
            $('.comp_ticket_cost').val(data['result'].se_29);
            $('.demand_pricing').val(data['result'].se_30);
            $('.number_performances').val(data['result'].se_31);
            $('.top_ticket_price').val(data['result'].se_32);
            $('.exchange_rate').val(data['result'].se_33);
            $('.box_office_pot').val(data['result'].se_34);
            $('.box_office_receipts').val(data['result'].se_35);
            $('.box_office_perc_pot').val(data['result'].se_36);
            $('.tax_1_perc').val(data['result'].se_37);
            $('.tax_1_amou').val(data['result'].se_38);
            $('.tax_2_perc').val(data['result'].se_39);
            $('.tax_2_amou').val(data['result'].se_40);
            $(".facility_perc").val(data['result'].se_41);
            $('.facility_amou').val(data['result'].se_42);
            $('.subs_perc').val(data['result'].se_43);
            $('.subs_amou').val(data['result'].se_44);
            $('.phone_perc').val(data['result'].se_45);
            $('.phone_amou').val(data['result'].se_46);
            $('.internet_perc').val(data['result'].se_47);
            $('.internet_amou').val(data['result'].se_48);
            $('.cc_perc').val(data['result'].se_49);
            $(".cc_amou").val(data['result'].se_50);
            $('.remote_perc').val(data['result'].se_51);
            $('.remote_amou').val(data['result'].se_52);
            $('.single_tix_perc').val(data['result'].se_53);
            $('.single_tix_amou').val(data['result'].se_54);
            $('.group_1_perc').val(data['result'].se_55);
            $('.group_1_amou').val(data['result'].se_56);
            $('.group_2_perc').val(data['result'].se_57);
            $('.group_2_amou').val(data['result'].se_58);
            $('.goldstar_perc').val(data['result'].se_59);
            $('.goldstar_amou').val(data['result'].se_60);
            $('.groupon_perc').val(data['result'].se_61);
            $('.groupon_amou').val(data['result'].se_62);
            $('.travelzoo_perc').val(data['result'].se_63);
            $('.travelzoo_amou').val(data['result'].se_64);
            $('.living_perc').val(data['result'].se_65);
            $('.living_amou').val(data['result'].se_66);
            $('.othera_perc').val(data['result'].se_67);
            $(".othera_amou").val(data['result'].se_68);
            $('.otherb_perc').val(data['result'].se_69);
            $('.otherb_amou').val(data['result'].se_70);
            $('.total_abo_expenses').val(data['result'].se_71);
            $('.deductions_gbor').val(data['result'].se_72);
            $('.nagbor').val(data['result'].se_73);
            $('.net_com_royalty').val(data['result'].se_74);
            $('.tax_withheld').val(data['result'].se_75);
            $(".total_com_royalty").val(data['result'].se_76);
            $('.total_com_guarantee').val(data['result'].se_77);
            $('.other_deduction').val(data['result'].se_78);
            $('.insurance_per').val(data['result'].se_79);
            $('.ticketprinting_per').val(data['result'].se_80);
            $('.advertising_bug').val(data['result'].se_81);
            $('.advertising_act').val(data['result'].se_82);
            $('.sh_loadin_bug').val(data['result'].se_83);
            $('.sh_loadin_act').val(data['result'].se_84);
            $(".sh_loadout_bug").val(data['result'].se_85);
            $('.sh_loadout_act').val(data['result'].se_86);
            $('.sh_running_bug').val(data['result'].se_87);
            $('.sh_running_act').val(data['result'].se_88);
            $('.wh_loadin_bug').val(data['result'].se_89);
            $('.wh_loadin_act').val(data['result'].se_90);
            $('.wh_loadout_bug').val(data['result'].se_91);
            $('.wh_loadout_act').val(data['result'].se_92);
            $('.wh_running_bug').val(data['result'].se_93);
            $('.wh_running_act').val(data['result'].se_94);
            $('.labor_catering_bug').val(data['result'].se_95);
            $('.labor_catering_act').val(data['result'].se_96);
            $('.musicians_bug').val(data['result'].se_97);
            $(".musicians_act").val(data['result'].se_98);
            $('.insurance_bug').val(data['result'].se_99);
            $('.insurance_act').val(data['result'].se_100);
            $('.ticketprinting_bug').val(data['result'].se_101);
            $('.ticketprinting_act').val(data['result'].se_102);
            $('.otherc_bug').val(data['result'].se_103);
            $('.otherc_act').val(data['result'].se_104);
            $('.st_variable_bug').val(data['result'].se_105);
            $('.st_variable_act').val(data['result'].se_106);
            $('.ada_bug').val(data['result'].se_107);
            $('.ada_act').val(data['result'].se_108);
            $('.boxoffice_bug').val(data['result'].se_109);
            $('.boxoffice_act').val(data['result'].se_110);
            $(".hospitality_bug").val(data['result'].se_111);
            $('.hospitality_act').val(data['result'].se_112);
            $('.third_equip_bug').val(data['result'].se_113);
            $('.third_equip_act').val(data['result'].se_114);
            $('.housestaff_bug').val(data['result'].se_115);
            $('.housestaff_act').val(data['result'].se_116);
            $('.licenses_bug').val(data['result'].se_117);
            $('.licenses_act').val(data['result'].se_118);
            $(".limos_bug").val(data['result'].se_119);
            $('.limos_act').val(data['result'].se_120);
            $('.orchestra_bug').val(data['result'].se_121);
            $('.orchestra_act').val(data['result'].se_122);
            $('.presenter_bug').val(data['result'].se_123);
            $('.presenter_act').val(data['result'].se_124);
            $('.security_bug').val(data['result'].se_125);
            $('.security_act').val(data['result'].se_126);
            $('.program_bug').val(data['result'].se_127);
            $(".program_act").val(data['result'].se_128);
            $('.rent_bug').val(data['result'].se_129);
            $('.rent_act').val(data['result'].se_130);
            $('.soundlights_bug').val(data['result'].se_131);
            $('.soundlights_act').val(data['result'].se_132);
            $('.ticketprinting2_bug').val(data['result'].se_133);
            $('.ticketprinting2_act').val(data['result'].se_134);
            $('.phone_int_bug').val(data['result'].se_135);
            $('.phone_int_act').val(data['result'].se_136);
            $('.dry_bug').val(data['result'].se_137);
            $('.dry_act').val(data['result'].se_138);
            $('.press_agent_bug').val(data['result'].se_139);
            $('.press_agent_act').val(data['result'].se_140);
            $('.otherd_bug').val(data['result'].se_141);
            $('.otherd_act').val(data['result'].se_142);
            $('.othere_bug').val(data['result'].se_143);
            $('.othere_act').val(data['result'].se_144);
            $('.otherf_bug').val(data['result'].se_145);
            $('.otherf_act').val(data['result'].se_146);
            $('.otherg_bug').val(data['result'].se_147);
            $(".otherg_act").val(data['result'].se_148);
            $('.piano_bug').val(data['result'].se_149);
            $('.piano_act').val(data['result'].se_150);
            $('.local_fixed_bug').val(data['result'].se_151);
            $('.local_fixed_act').val(data['result'].se_152);
            $('.st_expenses_bug').val(data['result'].se_153);
            $('.st_expenses_act').val(data['result'].se_154);
            $('.total_expenses_bug').val(data['result'].se_155);
            $('.total_expenses_act').val(data['result'].se_156);
            $('.t_engagement_act').val(data['result'].se_157);
            $('.overage_comp').val(data['result'].se_158);
            $('.net_star_overage').val(data['result'].se_159);
            $('.overage_pre').val(data['result'].se_160);
            $('.monies_comp').val(data['result'].se_161);
            $('.monies_pre').val(data['result'].se_162);
            $('.total_comp_overage').val(data['result'].se_163);
            $(".total_star_overage").val(data['result'].se_164);
            $('.pre_overage_pre').val(data['result'].se_165);
            $('.overage_share').val(data['result'].se_166);
            $('.money_rem_total').val(data['result'].se_167);
            $('.total_comp_share').val(data['result'].se_168);
            $('.less_direct_comp').val(data['result'].se_169);
            $('.adj_comp_share').val(data['result'].se_170);
            $('.total_pre_share').val(data['result'].se_171);
            $('.pre_facility_fee').val(data['result'].se_172);
            $('.adj_pre_share').val(data['result'].se_173);
            $('.notes').val(data['result'].se_174);

            $(".cityname").prop("value",data['result'].se_176);
            $(".statename").prop("value",data['result'].se_177);
            $(".cityid").prop("value",data['result'].se_175);
            
            $(".cityname").prop("disabled",true);
            $(".statename").prop("disabled",true);            

            setShowID = data['result'].se_2;
            setVenueID = data['result'].se_4;

            //getGlobalLocation(data['result'].se_175);
            getVenues(); 
            getShows();

            $("#datasettlements").show();
        }
        else{
            alert(data.msg);
        }
    }); 

}


function getUploadFile(){

    var call = new ajaxCallUpload();
    var form = $('#fileUploadForm')[0];
    var dataForm = new FormData(form);
    var url = '../routes/settlements_route.php?type=getUploadProcess';
    var method = "POST";
    var data = dataForm;
    call.sendUpload(data, url, method, function(data_response) {
        if(data_response.tp == 1){

            console.log(data_response);
            
            $('.opening_date').val(data_response['result'].se_6);
            $('.closing_date').val(data_response['result'].se_7);
            $('.drop_count').val(data_response['result'].se_8);
            $('.paid_attendance').val(data_response['result'].se_9);
            $('.comps').val(data_response['result'].se_10);
            $(".total_attendance").val(data_response['result'].se_11);
            $('.capacity').val(data_response['result'].se_12);
            $('.internet_sales').val(data_response['result'].se_13);
            $('.credit_card_sales').val(data_response['result'].se_14);
            $('.remote_outlet_sales').val(data_response['result'].se_15);
            $('.single_tix').val(data_response['result'].se_16);
            $('.group_sales_1').val(data_response['result'].se_17);
            $('.group_sales_2').val(data_response['result'].se_18);
            $(".goldstar").val(data_response['result'].se_19);
            $('.groupon').val(data_response['result'].se_20);
            $('.traveloo').val(data_response['result'].se_21);
            $('.living_social').val(data_response['result'].se_22);
            $('.other_percentage').val(data_response['result'].se_23);
            $('.other_amount').val(data_response['result'].se_24);
            $('.sub_discount').val(data_response['result'].se_25);
            $('.group1_discount').val(data_response['result'].se_26);
            $('.group2_discount').val(data_response['result'].se_27);
            $(".total_discount").val(data_response['result'].se_28);
            $('.comp_ticket_cost').val(data_response['result'].se_29);
            $('.demand_pricing').val(data_response['result'].se_30);
            $('.number_performances').val(data_response['result'].se_31);
            $('.top_ticket_price').val(data_response['result'].se_32);
            $('.exchange_rate').val(data_response['result'].se_33);
            $('.box_office_pot').val(data_response['result'].se_34);
            $('.box_office_receipts').val(data_response['result'].se_35);
            $('.box_office_perc_pot').val(data_response['result'].se_36);
            $('.tax_1_perc').val(data_response['result'].se_37);
            $('.tax_1_amou').val(data_response['result'].se_38);
            $('.tax_2_perc').val(data_response['result'].se_39);
            $('.tax_2_amou').val(data_response['result'].se_40);
            $(".facility_perc").val(data_response['result'].se_41);
            $('.facility_amou').val(data_response['result'].se_42);
            $('.subs_perc').val(data_response['result'].se_43);
            $('.subs_amou').val(data_response['result'].se_44);
            $('.phone_perc').val(data_response['result'].se_45);
            $('.phone_amou').val(data_response['result'].se_46);
            $('.internet_perc').val(data_response['result'].se_47);
            $('.internet_amou').val(data_response['result'].se_48);
            $('.cc_perc').val(data_response['result'].se_49);
            $(".cc_amou").val(data_response['result'].se_50);
            $('.remote_perc').val(data_response['result'].se_51);
            $('.remote_amou').val(data_response['result'].se_52);
            $('.single_tix_perc').val(data_response['result'].se_53);
            $('.single_tix_amou').val(data_response['result'].se_54);
            $('.group_1_perc').val(data_response['result'].se_55);
            $('.group_1_amou').val(data_response['result'].se_56);
            $('.group_2_perc').val(data_response['result'].se_57);
            $('.group_2_amou').val(data_response['result'].se_58);
            $('.goldstar_perc').val(data_response['result'].se_59);
            $('.goldstar_amou').val(data_response['result'].se_60);
            $('.groupon_perc').val(data_response['result'].se_61);
            $('.groupon_amou').val(data_response['result'].se_62);
            $('.travelzoo_perc').val(data_response['result'].se_63);
            $('.travelzoo_amou').val(data_response['result'].se_64);
            $('.living_perc').val(data_response['result'].se_65);
            $('.living_amou').val(data_response['result'].se_66);
            $('.othera_perc').val(data_response['result'].se_67);
            $(".othera_amou").val(data_response['result'].se_68);
            $('.otherb_perc').val(data_response['result'].se_69);
            $('.otherb_amou').val(data_response['result'].se_70);
            $('.total_abo_expenses').val(data_response['result'].se_71);
            $('.deductions_gbor').val(data_response['result'].se_72);
            $('.nagbor').val(data_response['result'].se_73);
            $('.net_com_royalty').val(data_response['result'].se_74);
            $('.tax_withheld').val(data_response['result'].se_75);
            $(".total_com_royalty").val(data_response['result'].se_76);
            $('.total_com_guarantee').val(data_response['result'].se_77);
            $('.other_deduction').val(data_response['result'].se_78);
            $('.insurance_per').val(data_response['result'].se_79);
            $('.ticketprinting_per').val(data_response['result'].se_80);
            $('.advertising_bug').val(data_response['result'].se_81);
            $('.advertising_act').val(data_response['result'].se_82);
            $('.sh_loadin_bug').val(data_response['result'].se_83);
            $('.sh_loadin_act').val(data_response['result'].se_84);
            $(".sh_loadout_bug").val(data_response['result'].se_85);
            $('.sh_loadout_act').val(data_response['result'].se_86);
            $('.sh_running_bug').val(data_response['result'].se_87);
            $('.sh_running_act').val(data_response['result'].se_88);
            $('.wh_loadin_bug').val(data_response['result'].se_89);
            $('.wh_loadin_act').val(data_response['result'].se_90);
            $('.wh_loadout_bug').val(data_response['result'].se_91);
            $('.wh_loadout_act').val(data_response['result'].se_92);
            $('.wh_running_bug').val(data_response['result'].se_93);
            $('.wh_running_act').val(data_response['result'].se_94);
            $('.labor_catering_bug').val(data_response['result'].se_95);
            $('.labor_catering_act').val(data_response['result'].se_96);
            $('.musicians_bug').val(data_response['result'].se_97);
            $(".musicians_act").val(data_response['result'].se_98);
            $('.insurance_bug').val(data_response['result'].se_99);
            $('.insurance_act').val(data_response['result'].se_100);
            $('.ticketprinting_bug').val(data_response['result'].se_101);
            $('.ticketprinting_act').val(data_response['result'].se_102);
            $('.otherc_bug').val(data_response['result'].se_103);
            $('.otherc_act').val(data_response['result'].se_104);
            $('.st_variable_bug').val(data_response['result'].se_105);
            $('.st_variable_act').val(data_response['result'].se_106);
            $('.ada_bug').val(data_response['result'].se_107);
            $('.ada_act').val(data_response['result'].se_108);
            $('.boxoffice_bug').val(data_response['result'].se_109);
            $('.boxoffice_act').val(data_response['result'].se_110);
            $(".hospitality_bug").val(data_response['result'].se_111);
            $('.hospitality_act').val(data_response['result'].se_112);
            $('.third_equip_bug').val(data_response['result'].se_113);
            $('.third_equip_act').val(data_response['result'].se_114);
            $('.housestaff_bug').val(data_response['result'].se_115);
            $('.housestaff_act').val(data_response['result'].se_116);
            $('.licenses_bug').val(data_response['result'].se_117);
            $('.licenses_act').val(data_response['result'].se_118);
            $(".limos_bug").val(data_response['result'].se_119);
            $('.limos_act').val(data_response['result'].se_120);
            $('.orchestra_bug').val(data_response['result'].se_121);
            $('.orchestra_act').val(data_response['result'].se_122);
            $('.presenter_bug').val(data_response['result'].se_123);
            $('.presenter_act').val(data_response['result'].se_124);
            $('.security_bug').val(data_response['result'].se_125);
            $('.security_act').val(data_response['result'].se_126);
            $('.program_bug').val(data_response['result'].se_127);
            $(".program_act").val(data_response['result'].se_128);
            $('.rent_bug').val(data_response['result'].se_129);
            $('.rent_act').val(data_response['result'].se_130);
            $('.soundlights_bug').val(data_response['result'].se_131);
            $('.soundlights_act').val(data_response['result'].se_132);
            $('.ticketprinting2_bug').val(data_response['result'].se_133);
            $('.ticketprinting2_act').val(data_response['result'].se_134);
            $('.phone_int_bug').val(data_response['result'].se_135);
            $('.phone_int_act').val(data_response['result'].se_136);
            $('.dry_bug').val(data_response['result'].se_137);
            $('.dry_act').val(data_response['result'].se_138);
            $('.press_agent_bug').val(data_response['result'].se_139);
            $('.press_agent_act').val(data_response['result'].se_140);
            $('.otherd_bug').val(data_response['result'].se_141);
            $('.otherd_act').val(data_response['result'].se_142);
            $('.othere_bug').val(data_response['result'].se_143);
            $('.othere_act').val(data_response['result'].se_144);
            $('.otherf_bug').val(data_response['result'].se_145);
            $('.otherf_act').val(data_response['result'].se_146);
            $('.otherg_bug').val(data_response['result'].se_147);
            $(".otherg_act").val(data_response['result'].se_148);
            $('.piano_bug').val(data_response['result'].se_149);
            $('.piano_act').val(data_response['result'].se_150);
            $('.local_fixed_bug').val(data_response['result'].se_151);
            $('.local_fixed_act').val(data_response['result'].se_152);
            $('.st_expenses_bug').val(data_response['result'].se_153);
            $('.st_expenses_act').val(data_response['result'].se_154);
            $('.total_expenses_bug').val(data_response['result'].se_155);
            $('.total_expenses_act').val(data_response['result'].se_156);
            $('.t_engagement_act').val(data_response['result'].se_157);
            $('.overage_comp').val(data_response['result'].se_158);
            $('.net_star_overage').val(data_response['result'].se_159);
            $('.overage_pre').val(data_response['result'].se_160);
            $('.monies_comp').val(data_response['result'].se_161);
            $('.monies_pre').val(data_response['result'].se_162);
            $('.total_comp_overage').val(data_response['result'].se_163);
            $(".total_star_overage").val(data_response['result'].se_164);
            $('.pre_overage_pre').val(data_response['result'].se_165);
            $('.overage_share').val(data_response['result'].se_166);
            $('.money_rem_total').val(data_response['result'].se_167);
            $('.total_comp_share').val(data_response['result'].se_168);
            $('.less_direct_comp').val(data_response['result'].se_169);
            $('.adj_comp_share').val(data_response['result'].se_170);
            $('.total_pre_share').val(data_response['result'].se_171);
            $('.pre_facility_fee').val(data_response['result'].se_172);
            $('.adj_pre_share').val(data_response['result'].se_173);
            $('.notes').val(data_response['result'].se_174);

            $("#settlement_data").show();
            $("#settlement_uploadfile").hide();
            $("#back_to_upload").show();

            onloadManagement();

        }else{
            alert(data_response.msg);
        }
    });
}

function onloadManagement(){
    getShows();
    getVenues();
}

$(function() {

    $(".countries").on("change", function(ev) {
        var countryId = $(this).val();
        if(countryId != ''){
            setCityId = 0;
            setStateId = 0;
            getStates(countryId);
        }else{
            $(".states option:gt(0)").remove();
        }
    });

    $(".states").on("change", function(ev) {
        var stateId = $(this).val();
        if(stateId != ''){
            getCities(stateId);
        }else{
            $(".cities option:gt(0)").remove();
        }
    });

    $(".venues").on("change", function(ev) {
        var venueId = $(this).val();
        if(venueId != ''){
            getCityOfVenues(venueId);
        }else{
            $(".venues option:gt(0)").remove();
        }
    });

    $("#btnUpload").click(function (ev) {
        getUploadFile();
    });

    $("#btnBackUpload").click(function (ev) {
        $("#settlement_data").hide();
        $("#settlement_uploadfile").show();
        $("#back_to_upload").hide();
    });

});