/**
 * Created by zvorskyi on 5/17/2016.
 */
var localApp =angular.module('localization',[]);
localApp.factory("locData",[function(){

    return {
        "ru": {
            "contacts_text" : "Если Вам близок мой стиль и Вы разделяете мои взгляды на свадебную фотографию - свяжитесь со мной удобным для Вас способом!<br>Буду рада знакомству и личной встрече!",
            "sidebarGreetings":"Привет! Меня зовут Оля, добро пожаловать на мой сайт! Если Вам близки мои работы, Вы можете связатся со мной любым удобным способом",
            "form":{

                "name" : {
                    "placeholder":"ИМЯ",
                    "isError":false,
                    "errDescription" : "Вы не ввели имя"
                },

                "city" : {
                    "placeholder":"ГОРОД",
                    "isError":false,
                    "errDescription" : "Вы не ввели город"
                },
                "email" : {
                    "placeholder":"E-MAIL",
                    "isError":false,
                    "errDescription" : "Не корректно введен E-mail"
                },
                "date" : {
                    "placeholder":"ДАТА СВАДЬБЫ",
                    "isError":false,
                    "errDescription" : "Дата уже занята"
                },
                "link" : {
                    "placeholder":"ССЫЛКА НА СОЦИАЛЬНУЮ СЕТЬ",
                    "isError":false,
                    "errDescription" : "Укажите профиль в соц. сетях"
                },
                "description" : {
                    "placeholder":"КРАТКИЙ ПЛАН СВАДЕБНОГО ДНЯ               +ссылки на место проведения",
                    "isError":false,
                    "errDescription" : "Добавте описание свадьбы"
                },

                "contacts_button" : "Давайте знакомится"


            },

            "Not_found_text" : "Страница не найдена",
            "Not_found_link" : "Вернуться на главную"
        },


        "en":{
            "contacts_text" : "If you are close to my style and you share my views on wedding photography - contact me convenient for you! <br>I will be glad to acquaintance and a personal meeting!",
            "sidebarGreetings":"Hi and welcome! I'm Olya, wedding photographer. If you find my style close to you contact me please:)",
            "form":{

                "name" : {
                    "placeholder":"NAME",
                    "isError":false,
                    "errDescription" : "Name required"
                },

                "city" : {
                    "placeholder":"CITY",
                    "isError":false,
                    "errDescription" : "City Required"
                },
                "email" : {
                    "placeholder":"E-MAIL",
                    "isError":false,
                    "errDescription" : "Improper  E-mail"
                },
                "date" : {
                    "placeholder":"BOOKING DATE",
                    "isError":false,
                    "errDescription" : "Date reserved already"
                },
                "link" : {
                    "placeholder":"LINK TO SOCIAL ACCOUNT",
                    "isError":false,
                    "errDescription" : "Social account link required"
                },
                "description" : {
                    "placeholder":"SHORT DESCRIPTION OF WEDDING DAY",
                    "isError":false,
                    "errDescription" : "Wedding description required"
                },

                "contacts_button" : "SEND"


            },

            "Not_found_text" : "Page not found",
            "Not_found_link" : "Return to portfolio"
        }
    }

}]);