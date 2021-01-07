import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import AppStore from "./AppStore";


if(document.getElementById("app")){
    ReactDOM.render(
          <AppStore />
       ,
        document.getElementById("app")
      );

}
