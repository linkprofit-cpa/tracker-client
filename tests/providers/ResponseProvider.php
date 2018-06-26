<?php

namespace linkprofit\Tracker\tests\providers;

use GuzzleHttp\Psr7\Response;

class ResponseProvider
{
    public function getSuccess()
    {
        $body = ['success' => true, 'authToken' => 'nice_token'];

        return new Response(200, [], json_encode($body));
    }

    public function getSuccessOffer()
    {
        $body = 'a:2:{s:5:"count";i:430;s:4:"data";a:1:{i:0;a:15:{s:7:"offerId";s:8:"o42kztk4";s:4:"name";s:21:"1С ИНТЕРЕС RU";s:11:"description";s:512:"<p>1С Интерес – федеральная сеть магазинов по продаже компьютерных и консольных игр (PlayStation, Xbox), игровых приставок и аксессуаров к ним, программного обеспечения для работы и отдыха, фильмов и музыкальных дисков, книг и аудиокниг, а также подарков и коллекционных сувениров.</p><p><br></p>";s:7:"logoUrl";s:78:"http://content.linkprofit.ru/images/logos/92afa9c7ce5172e2e058e37cd70334bd.png";s:6:"active";b:1;s:5:"rType";s:1:"P";s:14:"cookieLifeTime";i:30;s:20:"approvedTrafficTypes";a:11:{i:0;a:3:{s:6:"typeId";i:4;s:4:"name";s:49:"Реклама в социальных сетях";s:6:"status";s:1:"A";}i:1;a:3:{s:6:"typeId";i:7;s:4:"name";s:25:"Тизерная сеть";s:6:"status";s:1:"A";}i:2;a:3:{s:6:"typeId";i:8;s:4:"name";s:64:"Приложения/игры в социальных сетях";s:6:"status";s:1:"A";}i:3;a:3:{s:6:"typeId";i:11;s:4:"name";s:36:"E-mail рассылки (Белые)";s:6:"status";s:1:"A";}i:4;a:3:{s:6:"typeId";i:12;s:4:"name";s:34:"E-mail рассылки (Спам)";s:6:"status";s:1:"A";}i:5;a:3:{s:6:"typeId";i:15;s:4:"name";s:33:"Брокерский трафик";s:6:"status";s:1:"A";}i:6;a:3:{s:6:"typeId";i:25;s:4:"name";s:8:"Cashback";s:6:"status";s:1:"A";}i:7;a:3:{s:6:"typeId";i:31;s:4:"name";s:33:"Баннерная реклама";s:6:"status";s:1:"A";}i:8;a:3:{s:6:"typeId";i:32;s:4:"name";s:45:"Таргетированная реклама";s:6:"status";s:1:"A";}i:9;a:3:{s:6:"typeId";i:34;s:4:"name";s:24:"AdSpot/RichMedia/Sliding";s:6:"status";s:1:"A";}i:10;a:4:{s:6:"typeId";i:1;s:4:"name";s:13:"Другое:";s:6:"status";s:1:"A";s:14:"customTypeData";s:271:" Собственные веб-сайты, Скидочные и купонные агрегаторы, Другие партнерские сети, Собственные веб-сайты,Трафик из Facebook,Трафик из Instagram,Трафик из YouTube";}}s:20:"declinedTrafficTypes";a:6:{i:0;a:3:{s:6:"typeId";i:6;s:4:"name";s:8:"Popunder";s:6:"status";s:1:"D";}i:1;a:3:{s:6:"typeId";i:9;s:4:"name";s:31:"Дорвейный трафик";s:6:"status";s:1:"D";}i:2;a:3:{s:6:"typeId";i:13;s:4:"name";s:33:"SMS рассылки (Белые)";s:6:"status";s:1:"D";}i:3;a:3:{s:6:"typeId";i:14;s:4:"name";s:31:"SMS рассылки (Спам)";s:6:"status";s:1:"D";}i:4;a:3:{s:6:"typeId";i:17;s:4:"name";s:10:"ClickUnder";s:6:"status";s:1:"D";}i:5;a:3:{s:6:"typeId";i:26;s:4:"name";s:53:"Контекстная реклама на бренд";s:6:"status";s:1:"D";}}s:15:"offerCategories";a:3:{i:0;a:2:{s:10:"categoryId";i:14;s:4:"name";s:41:"Электронная коммерция";}i:1;a:3:{s:10:"categoryId";i:57;s:8:"parentId";i:14;s:4:"name";s:40:"Электроника и техника";}i:2;a:3:{s:10:"categoryId";i:73;s:8:"parentId";i:14;s:4:"name";s:20:"Софт и игры";}}s:16:"offerCommissions";a:1:{i:0;a:6:{s:12:"commissionId";s:8:"xya84f6p";s:4:"name";s:35:"оплачиваемый заказ";s:10:"commission";d:87;s:19:"displayedCommission";s:10:"0.45%-2.8%";s:8:"currency";a:3:{s:10:"currencyId";i:1;s:4:"name";s:10:"Рубль";s:9:"shortName";s:3:"₽";}s:10:"percentage";b:1;}}s:14:"offerCountries";a:1:{i:0;a:3:{s:9:"countryId";i:178;s:11:"countryName";s:18:"Russian Federation";s:11:"countryCode";s:2:"RU";}}s:10:"offerStats";a:5:{s:7:"offerId";s:8:"o42kztk4";s:3:"epc";d:0;s:2:"cr";d:0.0093457939999999993;s:2:"ar";d:0;s:5:"ratio";i:107;}s:6:"rating";s:3:"N/A";s:9:"isGateway";b:0;}}}#';

        return new Response(200, [], json_encode(unserialize($body)));
    }

    public function getError()
    {
        $body = ['success' => false, 'code' => 111];

        return new Response(200, [], json_encode($body));
    }

    public function getEmpty()
    {
        return new Response(200, [], json_encode([]));
    }
}
