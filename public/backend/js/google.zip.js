(function($) {
    $.extend({
        setState : function (post, googleApiKey, callback) {
            $.ajax({
                type        : 'get',
                url         : 'https://maps.googleapis.com/maps/api/geocode/json',
                crossDomain : true,
                dataType    : 'json',
                data        : {
                    key      : googleApiKey,
                    address  : post,
                    language : 'ja',
                    sensor   : false
                },
                success : function(resp) {
                    if (resp.status == "OK") {
                        // APIのレスポンスから住所情報を取得
                        const obj = resp.results[0].address_components;
                        if (obj.length < 4) {
                            return false;
                        }

                        var add = {};
                        if (obj.length == 7) {
                            add.name = obj[5]['long_name'];                          // 都道府県
                            add.city = obj[4]['long_name']+obj[3]['long_name'];      // 市区町村
                            add.address = obj[2]['long_name'] + obj[1]['long_name']; // 市区町村以下
                        } else if (obj.length == 6) {
                            add.name = obj[4]['long_name'];                     // 都道府県
                            add.city = obj[3]['long_name']+obj[2]['long_name']; // 市区町村
                            add.address = obj[1]['long_name'];                  // 市区町村以下
                        } else if (obj.length == 5) {
                            add.name = obj[3]['long_name'];    // 都道府県
                            add.city = obj[2]['long_name'];    // 市区町村
                            add.address = obj[1]['long_name']; // 市区町村以下
                        } else {
                            add.name = obj[2]['long_name']; // 都道府県
                            add.city = obj[1]['long_name']; // 市区町村
                        }

                        callback(add);
                    } else {
                        return false;
                    }
                }
            });
        }
    });
})(jQuery);
