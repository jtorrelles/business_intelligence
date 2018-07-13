
var setCityId = 0; 
var setStateId = 0;
var setCountryId = 0;
var setShowID = 0;
var setVenueID = 0;
var setPresenterID = 0;

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
                option.attr('value', val.id).text(val.name);
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
                option.attr('value', val.id).text(val.name);
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
                option.attr('value', val.id).text(val.name);
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
                option.attr('value', val.showid).text(val.showname);
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

function getVenues(status) {
    var call = new ajaxCall();
    var url = '../routes/venues_route.php?type=getVenuesByStatus&status='+status;
    var method = "GET";
    var data = {};
    console.log(url);
    $('.venues').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.venues').find("option:eq(0)").html("Select Venues");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', val.venueid).text(val.venuename);
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

function getPresenters() {
    var call = new ajaxCall();
    var url = '../routes/settlements_route.php?type=getPresenters';
    var method = "GET";
    var data = {};
    $('.presenters').find("option:eq(0)").html("Please wait..");
    call.send(data, url, method, function(data) {
        $('.presenters').find("option:eq(0)").html("Select Presenters");
        if(data.tp == 1){
            $.each(data['result'], function(key, val) {
                var option = $('<option />');
                option.attr('value', val.presenterid).text(val.presentername);
                $('.presenters').append(option);
            });
            $(".presenters").prop("disabled",false);

            //set venue value
            if(setPresenterID != 0){ 
                $(".presenters").val(setPresenterID);
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
            $('.subs_sales').val(data['result'].se_12_1);
            $('.phone_sales').val(data['result'].se_12_2);
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
			$('.presentername').val(data['result'].se_179);
			            
            $(".cityname").prop("disabled",true);
            $(".statename").prop("disabled",true);            

            setShowID = data['result'].se_2;
            setVenueID = data['result'].se_4;
		    setPresenterID = data['result'].se_180;

            //getGlobalLocation(data['result'].se_175);
            getVenues('%'); 
            getShows();
			getPresenters();

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
            $('.drop_count').val(Math.round(data_response['result'].se_8 * 100) / 100);
            $('.paid_attendance').val(Math.round(data_response['result'].se_9 * 100) / 100);
            $('.comps').val(Math.round(data_response['result'].se_10 * 100) / 100);
            $(".total_attendance").val(Math.round(data_response['result'].se_11 * 100) / 100);
            $('.capacity').val(Math.round(data_response['result'].se_12 * 100) / 100);
            $('.subs_sales').val(Math.round(data_response['result'].se_12_1 * 100) / 100);
            $('.phone_sales').val(Math.round(data_response['result'].se_12_2 * 100) / 100);
            $('.internet_sales').val(Math.round(data_response['result'].se_13 * 100) / 100);
            $('.credit_card_sales').val(Math.round(data_response['result'].se_14 * 100) / 100);
            $('.remote_outlet_sales').val(Math.round(data_response['result'].se_15 * 100) / 100);
            $('.single_tix').val(Math.round(data_response['result'].se_16 * 100) / 100);
            $('.group_sales_1').val(Math.round(data_response['result'].se_17 * 100) / 100);
            $('.group_sales_2').val(Math.round(data_response['result'].se_18 * 100) / 100);
            $(".goldstar").val(Math.round(data_response['result'].se_19 * 100) / 100);
            $('.groupon').val(Math.round(data_response['result'].se_20 * 100) / 100);
            $('.traveloo').val(Math.round(data_response['result'].se_21 * 100) / 100);
            $('.living_social').val(Math.round(data_response['result'].se_22 * 100) / 100);
            $('.other_percentage').val(Math.round(data_response['result'].se_23 * 100) / 100);
            $('.other_amount').val(Math.round(data_response['result'].se_24 * 100) / 100);
            $('.sub_discount').val(Math.round(data_response['result'].se_25 * 100) / 100);
            $('.group1_discount').val(Math.round(data_response['result'].se_26 * 100) / 100);
            $('.group2_discount').val(Math.round(data_response['result'].se_27 * 100) / 100);
            $(".total_discount").val(Math.round(data_response['result'].se_28 * 100) / 100);
            $('.comp_ticket_cost').val(Math.round(data_response['result'].se_29 * 100) / 100);
            $('.demand_pricing').val(Math.round(data_response['result'].se_30 * 100) / 100);
            $('.number_performances').val(Math.round(data_response['result'].se_31 * 100) / 100);
            $('.top_ticket_price').val(Math.round(data_response['result'].se_32 * 100) / 100);
            $('.exchange_rate').val(Math.round(data_response['result'].se_33 * 100) / 100);
            $('.box_office_pot').val(Math.round(data_response['result'].se_34 * 100) / 100);
            $('.box_office_receipts').val(Math.round(data_response['result'].se_35 * 100) / 100);
            $('.box_office_perc_pot').val(Math.round(data_response['result'].se_36 * 100) / 100);
            $('.tax_1_perc').val(Math.round(data_response['result'].se_37 * 100) / 100);
            $('.tax_1_amou').val(Math.round(data_response['result'].se_38 * 100) / 100);
            $('.tax_2_perc').val(Math.round(data_response['result'].se_39 * 100) / 100);
            $('.tax_2_amou').val(Math.round(data_response['result'].se_40 * 100) / 100);
            $(".facility_perc").val(Math.round(data_response['result'].se_41 * 100) / 100);
            $('.facility_amou').val(Math.round(data_response['result'].se_42 * 100) / 100);
            $('.subs_perc').val(Math.round(data_response['result'].se_43 * 100) / 100);
            $('.subs_amou').val(Math.round(data_response['result'].se_44 * 100) / 100);
            $('.phone_perc').val(Math.round(data_response['result'].se_45 * 100) / 100);
            $('.phone_amou').val(Math.round(data_response['result'].se_46 * 100) / 100);
            $('.internet_perc').val(Math.round(data_response['result'].se_47 * 100) / 100);
            $('.internet_amou').val(Math.round(data_response['result'].se_48 * 100) / 100);
            $('.cc_perc').val(Math.round(data_response['result'].se_49 * 100) / 100);
            $(".cc_amou").val(Math.round(data_response['result'].se_50 * 100) / 100);
            $('.remote_perc').val(Math.round(data_response['result'].se_51 * 100) / 100);
            $('.remote_amou').val(Math.round(data_response['result'].se_52 * 100) / 100);
            $('.single_tix_perc').val(Math.round(data_response['result'].se_53 * 100) / 100);
            $('.single_tix_amou').val(Math.round(data_response['result'].se_54 * 100) / 100);
            $('.group_1_perc').val(Math.round(data_response['result'].se_55 * 100) / 100);
            $('.group_1_amou').val(Math.round(data_response['result'].se_56 * 100) / 100);
            $('.group_2_perc').val(Math.round(data_response['result'].se_57 * 100) / 100);
            $('.group_2_amou').val(Math.round(data_response['result'].se_58 * 100) / 100);
            $('.goldstar_perc').val(Math.round(data_response['result'].se_59 * 100) / 100);
            $('.goldstar_amou').val(Math.round(data_response['result'].se_60 * 100) / 100);
            $('.groupon_perc').val(Math.round(data_response['result'].se_61 * 100) / 100);
            $('.groupon_amou').val(Math.round(data_response['result'].se_62 * 100) / 100);
            $('.travelzoo_perc').val(Math.round(data_response['result'].se_63 * 100) / 100);
            $('.travelzoo_amou').val(Math.round(data_response['result'].se_64 * 100) / 100);
            $('.living_perc').val(Math.round(data_response['result'].se_65 * 100) / 100);
            $('.living_amou').val(Math.round(data_response['result'].se_66 * 100) / 100);
            $('.othera_perc').val(Math.round(data_response['result'].se_67 * 100) / 100);
            $(".othera_amou").val(Math.round(data_response['result'].se_68 * 100) / 100);
            $('.otherb_perc').val(Math.round(data_response['result'].se_69 * 100) / 100);
            $('.otherb_amou').val(Math.round(data_response['result'].se_70 * 100) / 100);
            $('.total_abo_expenses').val(Math.round(data_response['result'].se_71 * 100) / 100);
            $('.deductions_gbor').val(Math.round(data_response['result'].se_72 * 100) / 100);
            $('.nagbor').val(Math.round(data_response['result'].se_73 * 100) / 100);
            $('.net_com_royalty').val(Math.round(data_response['result'].se_74 * 100) / 100);
            $('.tax_withheld').val(Math.round(data_response['result'].se_75 * 100) / 100);
            $(".total_com_royalty").val(Math.round(data_response['result'].se_76 * 100) / 100);
            $('.total_com_guarantee').val(Math.round(data_response['result'].se_77 * 100) / 100);
            $('.other_deduction').val(Math.round(data_response['result'].se_78 * 100) / 100);
            $('.insurance_per').val(Math.round(data_response['result'].se_79 * 100) / 100);
            $('.ticketprinting_per').val(Math.round(data_response['result'].se_80 * 100) / 100);
            $('.advertising_bug').val(Math.round(data_response['result'].se_81 * 100) / 100);
            $('.advertising_act').val(Math.round(data_response['result'].se_82 * 100) / 100);
            $('.sh_loadin_bug').val(Math.round(data_response['result'].se_83 * 100) / 100);
            $('.sh_loadin_act').val(Math.round(data_response['result'].se_84 * 100) / 100);
            $(".sh_loadout_bug").val(Math.round(data_response['result'].se_85 * 100) / 100);
            $('.sh_loadout_act').val(Math.round(data_response['result'].se_86 * 100) / 100);
            $('.sh_running_bug').val(Math.round(data_response['result'].se_87 * 100) / 100);
            $('.sh_running_act').val(Math.round(data_response['result'].se_88 * 100) / 100);
            $('.wh_loadin_bug').val(Math.round(data_response['result'].se_89 * 100) / 100);
            $('.wh_loadin_act').val(Math.round(data_response['result'].se_90 * 100) / 100);
            $('.wh_loadout_bug').val(Math.round(data_response['result'].se_91 * 100) / 100);
            $('.wh_loadout_act').val(Math.round(data_response['result'].se_92 * 100) / 100);
            $('.wh_running_bug').val(Math.round(data_response['result'].se_93 * 100) / 100);
            $('.wh_running_act').val(Math.round(data_response['result'].se_94 * 100) / 100);
            $('.labor_catering_bug').val(Math.round(data_response['result'].se_95 * 100) / 100);
            $('.labor_catering_act').val(Math.round(data_response['result'].se_96 * 100) / 100);
            $('.musicians_bug').val(Math.round(data_response['result'].se_97 * 100) / 100);
            $(".musicians_act").val(Math.round(data_response['result'].se_98 * 100) / 100);
            $('.insurance_bug').val(Math.round(data_response['result'].se_99* 100) / 100);
            $('.insurance_act').val(Math.round(data_response['result'].se_100 * 100) / 100);
            $('.ticketprinting_bug').val(Math.round(data_response['result'].se_101 * 100) / 100);
            $('.ticketprinting_act').val(Math.round(data_response['result'].se_102 * 100) / 100);
            $('.otherc_bug').val(Math.round(data_response['result'].se_103 * 100) / 100);
            $('.otherc_act').val(Math.round(data_response['result'].se_104 * 100) / 100);
            $('.st_variable_bug').val(Math.round(data_response['result'].se_105 * 100) / 100);
            $('.st_variable_act').val(Math.round(data_response['result'].se_106 * 100) / 100);
            $('.ada_bug').val(Math.round(data_response['result'].se_107 * 100) / 100);
            $('.ada_act').val(Math.round(data_response['result'].se_108 * 100) / 100);
            $('.boxoffice_bug').val(Math.round(data_response['result'].se_109 * 100) / 100);
            $('.boxoffice_act').val(Math.round(data_response['result'].se_110 * 100) / 100);
            $(".hospitality_bug").val(Math.round(data_response['result'].se_111 * 100) / 100);
            $('.hospitality_act').val(Math.round(data_response['result'].se_112 * 100) / 100);
            $('.third_equip_bug').val(Math.round(data_response['result'].se_113 * 100) / 100);
            $('.third_equip_act').val(Math.round(data_response['result'].se_114 * 100) / 100);
            $('.housestaff_bug').val(Math.round(data_response['result'].se_115 * 100) / 100);
            $('.housestaff_act').val(Math.round(data_response['result'].se_116 * 100) / 100);
            $('.licenses_bug').val(Math.round(data_response['result'].se_117 * 100) / 100);
            $('.licenses_act').val(Math.round(data_response['result'].se_118 * 100) / 100);
            $(".limos_bug").val(Math.round(data_response['result'].se_119 * 100) / 100);
            $('.limos_act').val(Math.round(data_response['result'].se_120 * 100) / 100);
            $('.orchestra_bug').val(Math.round(data_response['result'].se_121 * 100) / 100);
            $('.orchestra_act').val(Math.round(data_response['result'].se_122 * 100) / 100);
            $('.presenter_bug').val(Math.round(data_response['result'].se_123 * 100) / 100);
            $('.presenter_act').val(Math.round(data_response['result'].se_124 * 100) / 100);
            $('.security_bug').val(Math.round(data_response['result'].se_125 * 100) / 100);
            $('.security_act').val(Math.round(data_response['result'].se_126 * 100) / 100);
            $('.program_bug').val(Math.round(data_response['result'].se_127 * 100) / 100);
            $(".program_act").val(Math.round(data_response['result'].se_128 * 100) / 100);
            $('.rent_bug').val(Math.round(data_response['result'].se_129 * 100) / 100);
            $('.rent_act').val(Math.round(data_response['result'].se_130 * 100) / 100);
            $('.soundlights_bug').val(Math.round(data_response['result'].se_131 * 100) / 100);
            $('.soundlights_act').val(Math.round(data_response['result'].se_132 * 100) / 100);
            $('.ticketprinting2_bug').val(Math.round(data_response['result'].se_133 * 100) / 100);
            $('.ticketprinting2_act').val(Math.round(data_response['result'].se_134 * 100) / 100);
            $('.phone_int_bug').val(Math.round(data_response['result'].se_135 * 100) / 100);
            $('.phone_int_act').val(Math.round(data_response['result'].se_136 * 100) / 100);
            $('.dry_bug').val(Math.round(data_response['result'].se_137 * 100) / 100);
            $('.dry_act').val(Math.round(data_response['result'].se_138 * 100) / 100);
            $('.press_agent_bug').val(Math.round(data_response['result'].se_139 * 100) / 100);
            $('.press_agent_act').val(Math.round(data_response['result'].se_140 * 100) / 100);
            $('.otherd_bug').val(Math.round(data_response['result'].se_141 * 100) / 100);
            $('.otherd_act').val(Math.round(data_response['result'].se_142 * 100) / 100);
            $('.othere_bug').val(Math.round(data_response['result'].se_143 * 100) / 100);
            $('.othere_act').val(Math.round(data_response['result'].se_144 * 100) / 100);
            $('.otherf_bug').val(Math.round(data_response['result'].se_145 * 100) / 100);
            $('.otherf_act').val(Math.round(data_response['result'].se_146 * 100) / 100);
            $('.otherg_bug').val(Math.round(data_response['result'].se_147 * 100) / 100);
            $(".otherg_act").val(Math.round(data_response['result'].se_148 * 100) / 100);
            $('.piano_bug').val(Math.round(data_response['result'].se_149 * 100) / 100);
            $('.piano_act').val(Math.round(data_response['result'].se_150 * 100) / 100);
            $('.local_fixed_bug').val(Math.round(data_response['result'].se_151 * 100) / 100);
            $('.local_fixed_act').val(Math.round(data_response['result'].se_152 * 100) / 100);
            $('.st_expenses_bug').val(Math.round(data_response['result'].se_153 * 100) / 100);
            $('.st_expenses_act').val(Math.round(data_response['result'].se_154 * 100) / 100);
            $('.total_expenses_bug').val(Math.round(data_response['result'].se_155 * 100) / 100);
            $('.total_expenses_act').val(Math.round(data_response['result'].se_156 * 100) / 100);
            $('.t_engagement_act').val(Math.round(data_response['result'].se_157 * 100) / 100);
            $('.overage_comp').val(Math.round(data_response['result'].se_158 * 100) / 100);
            $('.net_star_overage').val(Math.round(data_response['result'].se_159 * 100) / 100);
            $('.overage_pre').val(Math.round(data_response['result'].se_160 * 100) / 100);
            $('.monies_comp').val(Math.round(data_response['result'].se_161 * 100) / 100);
            $('.monies_pre').val(Math.round(data_response['result'].se_162 * 100) / 100);
            $('.total_comp_overage').val(Math.round(data_response['result'].se_163 * 100) / 100);
            $(".total_star_overage").val(Math.round(data_response['result'].se_164 * 100) / 100);
            $('.pre_overage_pre').val(Math.round(data_response['result'].se_165 * 100) / 100);
            $('.overage_share').val(Math.round(data_response['result'].se_166 * 100) / 100);
            $('.money_rem_total').val(Math.round(data_response['result'].se_167 * 100) / 100);
            $('.total_comp_share').val(Math.round(data_response['result'].se_168 * 100) / 100);
            $('.less_direct_comp').val(Math.round(data_response['result'].se_169 * 100) / 100);
            $('.adj_comp_share').val(Math.round(data_response['result'].se_170 * 100) / 100);
            $('.total_pre_share').val(Math.round(data_response['result'].se_171 * 100) / 100);
            $('.pre_facility_fee').val(Math.round(data_response['result'].se_172 * 100) / 100);
            $('.adj_pre_share').val(Math.round(data_response['result'].se_173 * 100) / 100);
            $('.notes').val(data_response['result'].se_174);

            $("#settlement_data").show();
            $("#settlement_uploadfile").hide();
            $("#back_to_upload").show();
            $("#loader").hide();

            onloadManagement();

        }else{
            alert(data_response.msg);
            $("#loader").hide();
            $("#settlement_uploadfile").show();
        }
    });
}

function onloadManagement(){
    getShows();
    getVenues('Y');
	getPresenters();
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
        $("#loader").show();
        $("#settlement_uploadfile").hide();
        getUploadFile();
    });

    $("#btnBackUpload").click(function (ev) {
        $("#settlement_data").hide();
        $("#settlement_uploadfile").show();
        $("#back_to_upload").hide();
    });

});
