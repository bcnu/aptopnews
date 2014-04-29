/*************************************************
 *   mooquee v.1.1                               *
 *   Http: WwW.developer.ps/moo/mooquee          *
 *   Dirar Abu Kteish dirar@zanstudio.com        *
 *   2009-01-30                                  *
 *************************************************
 *   Extend By www.Sod.hu                        *
 *   new directions: top, bottom                 *
 *   2008-04-30                                  *
 /***********************************************/

var mooquee = new Class({initialize: function (b, a) {
    this.setOptions({marHeight: 40, marWidth: 550, steps: 1, speed: 40, direction: 'bottom', pauseOnOver: '0', pauseOnContainerOver: true}, a);
    this.timer = null;
    this.textElement = null;
    this.mooqueeElement = b;
    this.constructMooquee()
}, constructMooquee: function () {
    var a = this.mooqueeElement;
    a.setStyles({width: this.options.marWidth, height: this.options.marHeight});
    this.textElement = new Element('div', {'class': 'mooquee-text', id: 'mooquee-text'}).set('html', a.innerHTML);
    a.set('html', '');
    this.textElement.inject(a);
    if (!this.setStartPos()) {
        return
    }
    if (this.options.pauseOnOver == '1') {
        this.addMouseEvents()
    }
    this.timer = this.startMooquee.delay(this.options.speed, this)
}, setStartPos: function () {
    if (this.options.direction == 'bottom') {
        this.textElement.setStyle('bottom', (-1 * this.textElement.getCoordinates().height.toInt()))
    } else {
        if (this.options.direction == 'top') {
            this.textElement.setStyle('bottom', this.options.marHeight)
        } else {
            if (this.options.direction == 'left') {
                this.textElement.setStyle('left', (-1 * this.textElement.getCoordinates().width.toInt()))
            } else {
                if (this.options.direction == 'right') {
                    this.textElement.setStyle('left', this.options.marWidth)
                } else {
                    alert('direction config error: ' + this.options.direction);
                    return false
                }
            }
        }
    }
    return true
}, addMouseEvents: function () {
    if (!this.options.pauseOnContainerOver) {
        this.textElement.addEvents({mouseenter: function (a) {
            this.clearTimer()
        }.bind(this), mouseleave: function (a) {
            this.timer = this.startMooquee.delay(this.options.speed, this)
        }.bind(this)})
    } else {
        this.mooqueeElement.addEvents({mouseenter: function (a) {
            this.clearTimer()
        }.bind(this), mouseleave: function (a) {
            this.timer = this.startMooquee.delay(this.options.speed, this)
        }.bind(this)})
    }
}, startMooquee: function () {
    if (this.options.direction == 'bottom' || this.options.direction == 'top') {
        var a = this.textElement.getStyle('bottom').toInt()
    } else {
        if (this.options.direction == 'left' || this.options.direction == 'right') {
            var a = this.textElement.getStyle('left').toInt()
        }
    }
    if (this.options.direction == 'bottom') {
        this.textElement.setStyle('bottom', (a + -1) + 'px')
    } else {
        if (this.options.direction == 'top') {
            this.textElement.setStyle('bottom', (a + 1) + 'px')
        } else {
            if (this.options.direction == 'left') {
                this.textElement.setStyle('left', (a + -1) + 'px')
            } else {
                if (this.options.direction == 'right') {
                    this.textElement.setStyle('left', (a + 1) + 'px')
                }
            }
        }
    }
    this.checkEnd(a);
    this.timer = this.startMooquee.delay(this.options.speed, this)
}, resumeMooquee: function () {
    this.stopMooquee();
    if (this.options.pauseOnOver == '1') {
        this.addMouseEvents()
    }
    this.timer = this.startMooquee.delay(this.options.speed, this)
}, stopMooquee: function () {
    this.clearTimer();
    this.textElement.removeEvents()
}, clearTimer: function () {
    clearTimeout(this.timer);
    clearInterval(this.timer);
}, checkEnd: function (a) {
    if (this.options.direction == 'bottom') {
        if (a < -1 * (this.textElement.getCoordinates().height.toInt())) {
            this.textElement.setStyle('bottom', this.options.marHeight)
        }
    } else {
        if (this.options.direction == 'top') {
            if (a > this.options.marHeight.toInt()) {
                this.textElement.setStyle('bottom', -1 * (this.textElement.getCoordinates().height.toInt()))
            }
        } else {
            if (this.options.direction == 'left') {
                if (a < -1 * (this.textElement.getCoordinates().width.toInt())) {
                    this.textElement.setStyle('left', this.options.marWidth)
                }
            } else {
                if (this.options.direction == 'right') {
                    if (a > this.options.marWidth.toInt()) {
                        this.textElement.setStyle('left', -1 * (this.textElement.getCoordinates().width.toInt()))
                    }
                }
            }
        }
    }
}, setDirection: function (a) {
    this.options.direction = a;
    this.setStartPos()
}});

mooquee.implement(new Options);

/* mediahof */
window.addEvent('domready', function () {
    var options = {};
    $$('.mod_simple_marquee').each(function (item) {
        options['marWidth'] = item.getParent('div').getSize().x;
        options['marHeight'] = item.getParent('div').getSize().y;
        var config = item.getChildren()[0].getProperty('rel').split('|');
        config.each(function (cfg) {
            var tmp = cfg.split('=');
            options[tmp[0]] = tmp[1];
        });
        new mooquee(item.getChildren()[1], options);
    });
});