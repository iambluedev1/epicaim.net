var selectedSub;

var subs = [{
    name: 'VIP',
    price: 10,
    time: '1 month',
    selly_id: '8e5a68f5'
},{
    name: 'VIP+',
    price: 20,
    time: '3 month',
    selly_id: '898da72b'
},{
    name: 'Gold',
    price: 25,
    time: '6 month',
    selly_id: '446bdb31'
},{
    name: 'Platinium',
    price: 30,
    time: '24 month',
    selly_id: '8aba4397'
}];


$('#sub').slider().on('slideStart', function(ev){
    selectedSub = $('#sub').data('slider').getValue();
    display(selectedSub);
});

$('#sub').slider().on('slideStop', function(ev){
    var newVal = $('#sub').data('slider').getValue();
    if(selectedSub != newVal) {
        selectedSub = newVal;
        display(selectedSub);
    }
});

function display(i){
    var sub = subs[i];
    $(".sub_name").each(function(index, el) {
        $(el).text(sub.name);
    });
    
    $(".sub_price").each(function(index, el) {
        $(el).text(sub.price);
    });

    $(".sub_time").text(sub.time);

    $("#purchase_link").attr("data-selly-product", sub.selly_id);
    ready();
}