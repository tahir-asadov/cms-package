console.log('tacms:testing');
import Uploader from '@tahir-asadli/uploader';

const csrfTokenMeta = document.querySelector("meta[name=\"csrf-token\"]");
const headers       = {}
const url           = '/dashboard/media/store';
const fileInputId   = 'media-page-assets';
let token           = '';


if(csrfTokenMeta != undefined) {
  token = csrfTokenMeta.getAttribute("content");
}

if(!url || !fileInputId || !token) {
  console.error('Action, Id or CSRF token is empty');
  return false;
}

headers['X-CSRF-TOKEN'] = token;

const mediaConfig = {
    
  fileInputId: fileInputId,
  url: url,
  headers: headers,
  started: (files) => {
   console.log('Upload started', files);
  },
  progress: (fileId, progress) => {
    console.log('progress', fileId);
  },
  completed: (fileId) => {
    console.log('Completed', fileId);
  },
  error: (fileId, error) => {
    console.log('Error', fileId);
  },
}

new Uploader(mediaConfig);