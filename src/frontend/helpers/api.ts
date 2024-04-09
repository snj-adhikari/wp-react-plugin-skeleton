import axios from 'axios';

export const sendPostRequest =  async (url: string, data: any): Promise<any> => {
	return axios.post(url, data);
};
