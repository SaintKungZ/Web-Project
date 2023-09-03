//ให้ทำการเลือก node ทั้งหมดที่ class = .drop-zone__input
//ในที่นี้มี node เดียวที่ class = .drop-zone__input คืแ <input> ดังนั้นจะวน loop แค่ 1 รอบ
//inputElement = <input class="drop-zone__input">


document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {

  // current_element.closest(id/class); คือการไล่หา element บรรพบุรุษ(ไล่ขึ้นบน) 
  // ตาม id หรือ class ที่กำหนด โดยเริ่มหาจาก current_element
  // dropZoneElement = <div class="drop-zone"> ของ node ปัจจุบัน 

  const dropZoneElement = inputElement.closest(".drop-zone");

  //<--- ส่วนเพิ่มตัวตรวจจับเหตุการณ์กรณีที่ click dropZoneElement--->  
  dropZoneElement.addEventListener("click", (e) => 
    {   
      inputElement.click(); //ให้ทำการเหมือนคลิกตัวอัพโหลดไฟล์ หรือ inputElement ด้วย
    });

  //<--- ส่วนเพิ่มตัวตรวจจับเหตุการณ์กรณีที่มีการเปลี่ยนรูปภาพใน inputElement (จากกรณีการคลิกแล้วอัพโหลดภาพ)---> 
  inputElement.addEventListener("change", (e) => 
    {
      
      //กรณีที่มีการอัพไฟล์ขึ้นมาใหม่(ขนาดไฟล์ไม่เท่ากับ 0)
      if (inputElement.files.length) 
        {
          //files[0] คือการเลือกเฉพาะไฟล์แรกที่อัพโหลดขึ้นมา
          //เรียก updateThumbnail เพื่ออัพเดทตัวอย่างรูปภาพที่แสดง    
          updateThumbnail(dropZoneElement, inputElement.files[0]);
        }

    });

  //<--- ส่วนเพิ่มตัวตรวจจับเหตุการณ์กรณีที่มีการลากรูปภาพมาเหนือ dropZoneElement (อันนี้ยังไม่ได้ drop ภาพ) ---> 
  dropZoneElement.addEventListener("dragover", (e) => 
    {
      
      //ป้องกันการตาม URL ในที่นี้คือป้องกันไม่ให้ browser โหลด Tab ใหม่แล้วแสดงรูปภาพที่ upload ขึ้นมา
      e.preventDefault();

      // ให้เพิ่ม class drop-zone--over ออกจาก dropZoneElement
      dropZoneElement.classList.add("drop-zone--over");
    });


  
  //<--- ส่วนเพิ่มตัวตรวจจับเหตุการณ์ หลังวางภาพเสร็จ กับ กรณีที่ภาพที่กำลังลากอยู่นอก dropZoneElement --->
  // dragleave = คือ เหตุการณ์เกิดขึ้นเมื่อองค์ประกอบที่ลากออกจากเป้าหมายการวาง
  // dragend = คือ เหตุการณ์เกิดขึ้นเมื่อผู้ใช้ลากองค์ประกอบเสร็จแล้ว
  //ในที่นี้ type จะมีค่าเท่ากับ dragleave กับ dragend เพิ่มตัวตรวจจับ 2 แบบ

  ["dragleave", "dragend"].forEach((type) => 
    {       
      dropZoneElement.addEventListener(type, (e) => 
        {
          // ให้ลบ class drop-zone--over ออกจาก dropZoneElement
          dropZoneElement.classList.remove("drop-zone--over");
        });
    });


  //<--- ส่วนเพิ่มตัวตรวจจับเหตุการณ์กรณีวางภาพ หรือ drop ภาพ บน dropZoneElement --->
  dropZoneElement.addEventListener("drop", (e) => 
    {
      //ป้องกันการตาม URL ในที่นี้คือป้องกันไม่ให้ browser โหลด Tab ใหม่แล้วแสดงรูปภาพที่ upload ขึ้นมา
      e.preventDefault();
      
      //กรณีมีการ drop ไฟล์ภาพ(ขนาดไฟล์ไม่เท่ากับ 0)
      if (e.dataTransfer.files.length) 
      {
        //ให้ inputElement เก็บค่าไฟล์ที่อัพขึ้นมา
        inputElement.files = e.dataTransfer.files;
        
        //files[0] คือการเลือกเฉพาะไฟล์แรกที่อัพโหลดขึ้นมา
        //เรียก updateThumbnail เพื่ออัพเดทตัวอย่างรูปภาพที่แสดง  
        updateThumbnail(dropZoneElement, inputElement.files[0]);
      }

      // ให้ลบ class drop-zone--over ออกจาก dropZoneElement
      dropZoneElement.classList.remove("drop-zone--over");
    });
}); 

// <------------------------------------------------------------------------------------------------------------------------------------->

//ส่วนของ function ที่จะใช้แสดงตัวอย่างรูปภาพ
function updateThumbnail(dropZoneElement, file) 
  {     
      
      //กรณีไฟล์ที่อัพโหลดมาเป็นไฟล์รูปภาพ
      if (file.type.startsWith("image/"))
        {   
            dropZoneElement.querySelector(".drop-zone__input").setAttribute("name", "form_img_upload");
          
            //ให้ทำการเอา <span class="drop-zone__prompt"> ออก 
            if (dropZoneElement.querySelector(".drop-zone__prompt")) 
                {
                  dropZoneElement.querySelector(".drop-zone__prompt").remove();
                }

            //ทำการดึง Element <div class=".drop-zone__thumb"> ที่จะใช้แสดงรูปภาพ
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
          
            //ในครั้งแรกที่ยังไม่มีการอัพโหลดรูป จะไม่มี <div class=".drop-zone__thumb"> ดังนั้นจะให้ทำการสร้างขึ้นมา
            if (!thumbnailElement) 
                {
                  thumbnailElement = document.createElement("div");
                  thumbnailElement.classList.add("drop-zone__thumb");
                  dropZoneElement.appendChild(thumbnailElement);
                }
              
            //ส่วนเก็บชื่อรูปภาพที่จะนำมาแสดง
            // thumbnailElement.dataset.label = file.name;
          
            //show ตัวอย่างรูปภาพ(กรณีที่เป็นไฟล์รูปภาพ)
            
              //ประกาศตัวแปรที่จะใช้อ่านไฟล์
              const reader = new FileReader();
                
              //ให้ทำการอ่านค่า URL ของไฟล์ (ถ้าเป็นไฟล์ในเครื่องก็จะเป็น Path File)
              reader.readAsDataURL(file);

              //หลังจากอ่านเสร็จให้ทำการอัพเดทไฟล์ตัวอย่างขึ้นมา 
              reader.onload = () => {            
                  
              //เป็นการเปลี่ยน backgroundImage ของ <div class=".drop-zone__thumb">
              thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                  
                };   
        }
      
      //กรณีที่ไฟล์ที่อัพขึ้นมาไม่ใช่ไฟล์รูปภาพ
      else 
        {

          //ให้ทำการเอา <div class=".drop-zone__thumb"> ออก 
          if (dropZoneElement.querySelector(".drop-zone__thumb")) 
            {
              dropZoneElement.querySelector(".drop-zone__thumb").remove();
            }
          
          //ทำการดึง Element <span class="drop-zone__prompt"> ที่จะใช้แสดงข้อความ
          let promptElement = dropZoneElement.querySelector(".drop-zone__prompt")

          //กรณีที่ไม่มีให้ทำการสร้างขึ้นมา(เกิดจากกรณีถูกลบจากครั้งแรกอัพไฟล์รูปภาพ)
          if (!promptElement) 
            {
              promptElement = document.createElement("span");
              promptElement.classList.add("drop-zone__prompt");
              dropZoneElement.appendChild(promptElement);              
            }

          //set สี และ ข้อความแจ้ง error
          promptElement.innerHTML = "Error: Make sure you upload the image file.";
          promptElement.style.color = "red";

          //ให้ลบข้อมูลไฟล์ที่อัพมา 
          if (dropZoneElement.querySelector(".drop-zone__input")) 
          {
            //ลบ Attribute name ออก เพื่อไม่ให้ส่งค่าไปเก็บในฐานข้อมูล
            dropZoneElement.querySelector(".drop-zone__input").removeAttribute("name");           
           
          }
           
        }  

  }
  