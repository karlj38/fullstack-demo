import qs from 'qs';

const backendBaseUrl = 'http://localhost/api'

export async function getQuery(endpoint: string, params?: Record<string,any>) {
    return fetch(backendBaseUrl+'/'+endpoint+'?'+qs.stringify(params))
}