! function() {

    var today = moment();

    function Calendar(selector, events) {
        this.el = document.querySelector(selector);
        this.events = events;
        this.maxEvents = this.events.reduce(function(p, c){
            if(c.events.length > p) {
                return c.events.length;
            } else {
                return p;
            }
        }, 0);
        this.current = moment().date(1);
        this.draw();

        var current = document.querySelector('.today');
        if (current) {
            var self = this;
            window.setTimeout(function() {
                self.openDay(current);
            }, 500);
        }
    }

    Calendar.prototype.draw = function() {
        //Create Header
        this.drawHeader();
        //Draw Month
        this.drawMonth();
        // Draw Legend
       // this.drawLegend();

    }

    Calendar.prototype.drawHeader = function() {
        var self = this;
        if (!this.header) {
            //Create the header elements
            this.header = createElement('div', 'header');
            this.header.className = 'header';

            //this.title = createElement('h1');
            this.title = {
                month: createElement('div', 'month', this.current.format('MMMM')),
                year: createElement('div', 'year', this.current.format('YYYY'))
            };

            var right = createElement('div', 'right');
            right.addEventListener('click', function() {
                self.nextMonth();
                self.colorBusy();
                })


            var left = createElement('div', 'left');
            left.addEventListener('click', function() {
                self.prevMonth();
                self.colorBusy();

            });

            var ringLeft = createElement('div', 'ring-left');
            var ringRight = createElement('div', 'ring-right');
            //Append the Elements
            //this.header.appendChild(this.title);
            this.header.appendChild(this.title.month);
            this.header.appendChild(this.title.year);
            this.header.appendChild(ringLeft);
            this.header.appendChild(ringRight);

            this.header.appendChild(right);
            this.header.appendChild(left);
            this.el.appendChild(this.header);
            this.drawWeekDays();
        }

        //this.title.innerHTML = this.current.format('MMMM YYYY');
        this.title.month.innerHTML = this.current.format('MMMM');
        this.title.year.innerHTML = this.current.format('YYYY');
    }

    Calendar.prototype.drawMonth = function() {
        var self = this;

        this.events.forEach(function(event) {
            //ev.date = self.current.clone().date(Math.random() * (29 - 1) + 1);
            event.date = moment(event.date);
        });

        if (this.month) {
            this.oldMonth = this.month;
            this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'previous');
           // this.oldMonth.addEventListener('webkitAnimationEnd', function() {
                self.oldMonth.parentNode.removeChild(self.oldMonth);
                self.month = createElement('div', 'month');
                self.backFill();
                self.currentMonth();
                self.fowardFill();

                self.el.appendChild(self.month);

                window.setTimeout(function() {
                    self.month.className = 'month in ' + (self.next ? 'next' : 'previous');
                }, 16);
            //});
        } else {
            this.month = createElement('div', 'month');
            this.el.appendChild(this.month);
            this.backFill();
            this.currentMonth();
            this.fowardFill();
            this.month.className = 'month new';
            this.colorBusy();



        }
    }

    Calendar.prototype.backFill = function() {
        var clone = this.current.clone();
        var dayOfWeek = clone.day();

        if (!dayOfWeek) {
            dayOfWeek=7;
        }

        clone.subtract('days', dayOfWeek);

        for (var i = dayOfWeek; i > 0; i--) {
            this.drawDay(clone.add('days', 1));
        }
    }

    Calendar.prototype.fowardFill = function() {
        var clone = this.current.clone().add('months', 1).subtract('days', 1);
        var dayOfWeek = clone.day();

        if (clone.day()===0) {
            return;
        }

        for (var i = dayOfWeek; i < 6; i++) {
            this.drawDay(clone.add('days', 1));
        }
        this.drawDay(clone.add('days', 1));
    }

    Calendar.prototype.currentMonth = function() {
        var clone = this.current.clone();
        clone.add('days', 1);
        while (clone.month() === this.current.month()) {
            this.drawDay(clone);
            clone.add('days', 1);
        }
    }

    Calendar.prototype.getWeek = function(day) {
        if (!this.week || day.day() === 1) {
            this.week = createElement('div', 'week');
            this.month.appendChild(this.week);
        }
    }

    Calendar.prototype.drawDay = function(day) {
        var self = this;
        this.getWeek(day);

        var todayEvents = this.events.filter(function(event){
            return event.date.isSame(day, 'cday');
        })[0];

        //Outer Day
        var outer = createElement('div', this.getDayClass(day));
        var circle = createElement('span', 'circle');
        if(todayEvents) {
            outer.addEventListener('click', function() {
                self.openDay(this);
            });
            // Circle
            var size = (1 / this.maxEvents) * todayEvents.events.length;
            circle.style.webkitTransform = 'scale(' + size + ')';
            circle.style.MozProperty = 'scale(' + size + ')';
            circle.style.transform = 'scale(' + size + ')';
        } else {
            circle.style.webkitTransform = 'scale(0, 0)';
            circle.style.MozProperty = 'scale(0, 0)';
            circle.style.transform = 'scale(0, 0)';
            outer.style.cursor = 'default';
        }

        //Day Name
        var name = createElement('div', 'day-name', day.format('ddd'));

        //Day Number
        var number = createElement('div', 'day-number', day.format('DD'));

        //Events
        var events = createElement('div', 'day-events');
        this.drawEvents(day, events);

        //outer.appendChild(name);
        outer.appendChild(circle);
        outer.appendChild(number);
        //outer.appendChild(events);
        this.week.appendChild(outer);
    }

    Calendar.prototype.drawEvents = function(day, element) {
        if (day.month() === this.current.month()) {
            var todaysEvents = this.events.reduce(function(memo, ev) {
                if (ev.date.isSame(day, 'cday')) {
                    memo.push(ev);
                }
                return memo;
            }, []);

            todaysEvents.forEach(function(ev) {
                var evSpan = createElement('span', ev.color);
                element.appendChild(evSpan);
            });
        }
    }

    Calendar.prototype.getDayClass = function(day) {
        classes = ['cday'];
        if (day.month() !== this.current.month()) {
            classes.push('other');
        } else if (today.isSame(day, 'day')) {
            classes.push('today');
        }
        return classes.join(' ');
    }

    Calendar.prototype.openDay = function(el) {
        var details, arrow;
        var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
        var day = this.current.clone().date(dayNumber);

        var currentOpened = document.querySelector('.details');

        //Check to see if there is an open detais box on the current row
        if (currentOpened && currentOpened.parentNode === el.parentNode) {
            details = currentOpened;
            arrow = document.querySelector('.arrow');
        } else {
            //Close the open events on differnt week row
            //currentOpened && currentOpened.parentNode.removeChild(currentOpened);
            if (currentOpened) {
                currentOpened.addEventListener('webkitAnimationEnd', function() {
                    currentOpened.parentNode.removeChild(currentOpened);
                });
                currentOpened.addEventListener('oanimationend', function() {
                    currentOpened.parentNode.removeChild(currentOpened);
                });
                currentOpened.addEventListener('msAnimationEnd', function() {
                    currentOpened.parentNode.removeChild(currentOpened);
                });
                currentOpened.addEventListener('animationend', function() {
                    currentOpened.parentNode.removeChild(currentOpened);
                });
                currentOpened.className = 'details out';
            }

            //Create the Details Container
            details = createElement('div', 'details in');

            //Create the arrow
            var arrow = createElement('div', 'arrow');

            //Create the event wrapper
            details.appendChild(arrow);
            el.parentNode.appendChild(details);
        }

        var todaysEvents = this.events.filter(function(event){
            return event.date.isSame(day, 'cday');
        });

       // console.log('m: ', todaysEvents)
        this.renderEvents(todaysEvents, details);

        arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + (el.offsetWidth / 2) + 'px';
    }

    Calendar.prototype.renderEvents = function(events, ele) {
        //Remove any events in the current details element
        var currentWrapper = ele.querySelector('.events');
        var wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));

        if(events.length < 1) {
            return;
        }
        console.log("events: ", events);
        events[0].events.forEach(function(ev) {
            console.log("evv: ", ev);
            var div = createElement('div', 'event');
            var square = createElement('div', 'event-category ' + ev.color);
            var span = createElement('span', '', ev.name);

            div.appendChild(square);
            div.appendChild(span);
            wrapper.appendChild(div);
        });

        if (!events.length) {
            var div = createElement('div', 'event empty');
            var span = createElement('span', '', 'No Events');

            div.appendChild(span);
            wrapper.appendChild(div);
        }

        if (currentWrapper) {
            currentWrapper.className = 'events out';
            currentWrapper.addEventListener('webkitAnimationEnd', function() {
                currentWrapper.parentNode.removeChild(currentWrapper);
                ele.appendChild(wrapper);
            });
            currentWrapper.addEventListener('oanimationend', function() {
                currentWrapper.parentNode.removeChild(currentWrapper);
                ele.appendChild(wrapper);
            });
            currentWrapper.addEventListener('msAnimationEnd', function() {
                currentWrapper.parentNode.removeChild(currentWrapper);
                ele.appendChild(wrapper);
            });
            currentWrapper.addEventListener('animationend', function() {
                currentWrapper.parentNode.removeChild(currentWrapper);
                ele.appendChild(wrapper);
            });
        } else {
            ele.appendChild(wrapper);
        }
    }

    Calendar.prototype.drawWeekDays = function(el) {
        var self = this;
        this.weekDays = createElement('div', 'week-days')
        var weekdays = [ 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN']
        weekdays.forEach(function(weekday){
            var day = createElement('span', 'cday', weekday);
            self.weekDays.appendChild(day);
        })
        this.el.appendChild(this.weekDays);
    }

    Calendar.prototype.drawLegend = function() {
        var legend = createElement('div', 'legend');
        var calendars = this.events.map(function(e) {
            return e.calendar + '|' + e.color;
        }).reduce(function(memo, e) {
            if (memo.indexOf(e) === -1) {
                memo.push(e);
            }
            return memo;
        }, []).forEach(function(e) {
            var parts = e.split('|');
            var entry = createElement('span', 'entry ' + parts[1], parts[0]);
            legend.appendChild(entry);
        });
        this.el.appendChild(legend);
    }

    Calendar.prototype.nextMonth = function() {
        this.current.add('months', 1);
        this.next = true;
        this.draw();



    }

    Calendar.prototype.prevMonth = function() {
        this.current.subtract('months', 1);
        this.next = false;
        this.draw();



    }
    Calendar.prototype.colorBusy = function(){
    curr_year = this.current.format('YYYY');
    curr_month = this.current.format('MM');

// Rise when we change date to fill description

        busydays=[];
             $.ajaxSetup({ cache: false });

            $.getJSON( "Busy1.Json", function(data) {
              $.each ( data, function( key, val ){
                   Busy_month = key.substr(3,2);
                   Busy_year = key.substr(6,4);
                   Busy_day = key.substr(0,2);
                        if(Busy_month==curr_month&&Busy_year==curr_year){
                            busydays.push(Busy_day);
                        }})

                   }
                )
        $.ajaxSetup({ cache: true });


window.setTimeout(function(){

      //  busydays =["15","18"];

       if (busydays.length!=0){

                //replacement based on week started at monday
                var previus
                $ (".day-number").each(

                    function(){

                        //console.log( $(this).text()+" /"+previus)

                        $(this).text(previus)
                        //this.$ (".day-number").next($ (".day-number").text())
                        next =  $(this).text()
                    }
                );

                for(var i=0; i<busydays.length; i++){

                    searchDay = busydays[i];
                    if (busydays[i].length==1){
                        searchDay = "0" + busydays[i];
                    }

                    var Selectday =   $( ".day-number:contains(" +searchDay+")");

                    if(Selectday.length>1){

                        for (n = 0; n < Selectday.length; n++) {

                            if (Selectday[n].parentElement.className == 'cday'){
                                Selectday[n].style.backgroundColor = "red";
                                Selectday[n].style.color = "white";
                                Selectday[n].style.marginLeft  = "8px";
                                Selectday[n].style.marginRight  = "8px";
                                Selectday[n].style.borderRadius  = "20px";
                            }
                        }
                    }
                    else{
                        $( ".cday .day-number:contains(" +searchDay+")").css({
                            "background-color": "red",
                            "color": "white",
                            "border-radius": "20px",
                            "margin-left": "8px",
                            "margin-right": "8px"})
                    }
                }


    };


    },300)
}


    window.Calendar = Calendar;

    function createElement(tagName, className, innerText) {
        var element = document.createElement(tagName);
        if (className) {
            element.className = className;
        }
        if (innerText) {
            element.innderText = element.textContent = innerText;
        }
        return element;
    }''
}();

var app = angular.module('myApp', []);
app.controller('AppCtrl', function($scope){

});
app.directive('calendar', [function(){
    return {
        restrict: 'EA',
        scope: {
            date: '=',
            events: '='
        },
        link: function(scope, element, attributes) {
            var data = [{
                date: new Date(2013, 9,8),
                events: [{
                    name: 'wedding of Nastya and Sergii',
                    type: 'bot',
                    color: 'red'
                }]
             }]
            var calendar = new Calendar('#calendar', data);
        }
    }
}]);
window.setTimeout(function(){Calendar.prev},1000)



/*
   *************  erase errors when fields changed ****************
*/

$("#CheckedDate").change(function() {
    $.ajaxSetup({ cache: false });
    $.getJSON( "Busy1.json", function(data) {
        if(data[$("#CheckedDate").val()]&&$("#CheckedDate").val()!="")
        {
            $("#CheckedDate").css("border-color", "red")
            //$(".calendar").css("display","none")
            $("#s_CheckedDate").fadeOut(400,function() {
                // Animation complete
                $("#s_CheckedDate").css("display","block")
               // $(".calendar").css("display","block")
                $("#s_CheckedDate").text("Дата уже занята")
            }) }
        //empty date
            else if($("#CheckedDate").val()===""){
            $("#CheckedDate").css("border-color", "red")
            //$(".calendar").css("display","none")
            $("#s_CheckedDate").fadeOut(400,function() {
                // Animation complete
                $("#s_CheckedDate").text("Укажите Дату")
                $("#s_CheckedDate").css("display","block")
                // $(".calendar").css("display","block")
            })
        }



        else{
            $("#CheckedDate").css("border-color", "#ccc")

            $("#s_CheckedDate").fadeOut(400,function() {
                // Animation complete
                $("#s_CheckedDate").text("Дата уже занята")
                $("#s_CheckedDate").css("display","none")});


        }

    });

    $.ajaxSetup({ cache: true});

});





$("#f_name").change(function() {
    if( $( "#f_name").val())
    {
        $("#f_name").css("border-color", "#ccc")
        $("#s_name").fadeOut(400,function() {
        // Animation complete
        $("#s_name").css("display","none")});
    }
    else{
        $("#f_name").css("border-color", "red")

        $("#s_name").fadeIn(400, function() {
            // Animation complete
            $("#s_name").css("display","block")});
    }
})



$("#f_mail").change(function() {
    if( validateEmail($( "#f_mail").val()))
    {
        $("#f_mail").css("border-color", "#ccc")
        $("#s_mail").fadeOut(400,function() {
            // Animation complete
            $("#s_mail").css("display","none")});
    }
    else{
        $("#f_mail").css("border-color", "red")

        $("#s_mail").fadeIn(400, function() {
            // Animation complete
            $("#s_mail").css("display","block")});
    }
})

$("#f_city").change(function() {
    if( $("#f_city").val())
    {
        $("#f_city").css("border-color", "#ccc")
        $("#s_city").fadeOut(400,function() {
            // Animation complete
            $("#s_city").css("display","none")});
    }
    else{
        $("#f_city").css("border-color", "red")

        $("#s_city").fadeIn(400, function() {
            // Animation complete
            $("#s_city").css("display","block")});
    }
})

$("#f_social").change(function() {
    if( $( "#f_social").val())
    {
        $("#f_social").css("border-color", "#ccc")
        $("#s_social").fadeOut(400,function() {
            // Animation complete
            $("#s_social").css("display","none")});
    }
    else{
        $("#f_social").css("border-color", "red")

        $("#s_social").fadeIn(400, function() {
            // Animation complete
            $("#s_social").css("display","block")});
    }
})

$("#f_textarea").change(function() {
    if( $( "#f_textarea").val())
    {
        $("#f_textarea").css("border-color", "#ccc")
        $("#s_descr").fadeOut(400,function() {
            // Animation complete
            $("#s_descr").css("display","none")});
    }
    else{
        $("#f_textarea").css("border-color", "red")

        $("#s_descr").fadeIn(400, function() {
            // Animation complete
            $("#s_descr").css("display","block")});
    }
})



function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

// if all fields filled send form
$( "#send_mail" ).click(function() {
    FieldsOK = true;
    if(!$( "#f_name").val()){
        $("#f_name").css("border-color", "red")
        $("#s_name").fadeIn(400, function() {
            // Animation complete
            $("#s_name").css("display","block")});
        FieldsOK = false;
    }
    if(!validateEmail($( "#f_mail").val())){
        $("#f_mail").css("border-color", "red")
        $("#s_mail").fadeIn(400, function() {
            // Animation complete
            $("#s_mail").css("display","block")});
        FieldsOK = false;
    }
    if($("#CheckedDate").css("border-color")== "rgb(255, 0, 0)"||!$( "#CheckedDate").val()){
        $("#CheckedDate").css("border-color", "red")
        $("#s_CheckedDate").fadeIn(400, function() {
            // Animation complete
            $("#s_CheckedDate").css("display","block")});
        FieldsOK = false;
    }
    if(!$("#f_city").val()){
        $("#f_city").css("border-color", "red")
        $("#s_city").fadeIn(400, function() {
            // Animation complete
            $("#s_city").css("display","block")});
        FieldsOK = false;
    }
    if(!$("#f_social").val()){
        $("#f_social").css("border-color", "red")
        $("#s_social").fadeIn(400, function() {
            // Animation complete
            $("#s_social").css("display","block")});
        FieldsOK = false;
    }

    if(!$( "#f_textarea").val()){
        $("#f_textarea").css("border-color", "red")
        $("#s_descr").fadeIn(400, function() {
            // Animation complete
            $("#s_descr").css("display","block")});
        FieldsOK = false;
    }
    if (!FieldsOK){
        return false;
    }
})

