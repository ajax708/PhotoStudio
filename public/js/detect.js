    var obj_user = user;
    var obj_photos = photos;
    //console.log(obj_photos)
    async function detect_images(){
        const MODEL_URL = '/models';
        await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
        await faceapi.loadFaceLandmarkModel(MODEL_URL)
        await faceapi.loadFaceRecognitionModel(MODEL_URL)

        //get facedescriptor of user image (only once time)
        //para mayor precision puedes disminuir la dimension de la imagen usando canvas
        const labels = [obj_user.fullname]
        const labeledFaceDescriptors = await Promise.all(
            labels.map(async label => {
                //fetch image data from urls and convert blob to HTMLImage element
                const profile = '/photos/'+ obj_user.image
                const img = await faceapi.fetchImage(profile)
                // detect the face with the highest score in the image and compute it's landmarks and face descriptor
                const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                if (!fullFaceDescription) {
                    throw new Error(`no faces detected for ${label}`)
                }
                const faceDescriptors = [fullFaceDescription.descriptor]
                return new faceapi.LabeledFaceDescriptors(label, faceDescriptors)
            })
        )
        //console.log(labeledFaceDescriptors)
        var pictures = [];
        //get facedescriptor of all faces in photo event
        for(var i = 0; i < obj_photos.length; i++) { 
            const input = '/photos/'+ obj_photos[i].eventphoto_route
            const fetch_input = await faceapi.fetchImage(input)
            let fullFaceDescriptions = await faceapi.detectAllFaces(fetch_input).withFaceLandmarks().withFaceDescriptors()
        
            //match the results of descriptor in photo event to descriptor user image
            const maxDescriptorDistance = 0.6
            const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, maxDescriptorDistance)
            const results = fullFaceDescriptions.map(fd => faceMatcher.findBestMatch(fd.descriptor))
            //console.log(results)
            for (let index = 0; index < results.length; index++) {
                if (results[index]._label == obj_user.fullname) {
                        pictures.push({
                        photo_id          : obj_photos[i].id,
                        user_id           : obj_user.id,
                        });
                        break;
                }  
            }
        }
        return pictures;
    }

    (async function main() { 
        let res = await detect_images();
        if (res === undefined || res.length == 0) {
            alert('No Apareces en Fotos');
        }else{
            $.ajax({
                url: '/detect/post-data',
                type: "POST",
                data: {res:res},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success:function(){
                    alert('Deteccion Completa');
                  }, error:function(){
                    alert('Ups, Error'); 
                  }
              });
        } 
    })();
    
