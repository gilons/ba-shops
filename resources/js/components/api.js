
const CSRF_TOKEN = document.head.querySelector('meta[name="csrf-token"]');
const header = {
    Accept: "application/json",
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": CSRF_TOKEN && CSRF_TOKEN.content
}
const api = window.axios
class API {
    post(route,data){
       return api.post(route,data,{header})        
    }
    get(route,data){
        return api.get(route, data, { header})
    }
    delete(route,data){
        return api.delete(route, data, {header})
    }
}
const ABAPI = new API()
export default ABAPI