import './bootstrap';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

const notyf = new Notyf({
   duration: 3000,
   position: {
      x:'center',
      y:'top',
   }
});

window.notyf = notyf;


// import {livewire_hot_reload} from 'virtual:livewire-hot-reload'

// livewire_hot_reload();
