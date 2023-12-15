import './bootstrap';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import Chart from 'chart.js/auto';

const notyf = new Notyf({
   duration: 5000,
   position: {
      x:'center',
      y:'top',
   }
});

const escKey = new KeyboardEvent('keydown', {
   key: 'Escape',
   keyCode: 27,
   which: 27,
   code: 'Escape',
});

window.Chart = Chart;
window.notyf = notyf;
window.escKey = escKey;


// import {livewire_hot_reload} from 'virtual:livewire-hot-reload'

// livewire_hot_reload();
