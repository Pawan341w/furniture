// JS Functions
const aesKey = CryptoJS.enc.Utf8.parse("12345678901234567890123456789012"); // same as .env key
const aesIv = CryptoJS.enc.Utf8.parse("1234567890123456"); // same as .env iv

function encryptDataJS(plainText) {
  const encrypted = CryptoJS.AES.encrypt(plainText, aesKey, {
    iv: aesIv,
    mode: CryptoJS.mode.CBC,
    padding: CryptoJS.pad.Pkcs7
  });
  return encrypted.toString();
}

 function decryptDataJS(encrypted) {
        const key = CryptoJS.enc.Utf8.parse("12345678901234567890123456789012");
        const iv = CryptoJS.enc.Utf8.parse("1234567890123456");

        const decrypted = CryptoJS.AES.decrypt(encrypted, key, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });

        const plaintext = decrypted.toString(CryptoJS.enc.Utf8);

        try {
            return JSON.parse(plaintext);
        } catch (e) {
            console.error("JSON parse error:", e);
            return [];
        }
    }
