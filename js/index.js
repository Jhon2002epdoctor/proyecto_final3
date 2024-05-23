import { Megusta, attachClickHandlers } from "../common/Inserccion.js";

import { LlamadasDestacadas} from "./llamadasDestacadas.js";


document.addEventListener('DOMContentLoaded',  async ()  =>{
 await LlamadasDestacadas();
       attachClickHandlers();
       Megusta();
});






