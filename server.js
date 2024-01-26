const express = require('express');
const cors = require('cors');
const  app = express();
const Pusher = require("pusher");
const router = express.Router();

const pusher = new Pusher({
    appId: "1622659",
    key: "8da638e755b12b48f892",
    secret: "2b7c2552809807d6c5c6",
    cluster: "ap2",
    useTLS: true
});

app.use(express.json());
app.use(cors());

router.post('/message/send', (req, res) => {
    console.log(req, res);
    pusher.trigger("my-channel", "my-event", {
        message: "hello world"
    });
});




app.listen(5050, ()=>{
    console.log('server is running, PORT: 5050')
});












// const express = require('express');
// const cors = require('cors');
//
// const  app = express();
// app.use(cors({ origin: '*' }));
//
// const server = require('https').createServer(app);
//
// const io = require('socket.io')(server,  {
//     cors: {origin: "*"}
// });
//
// console.log(1);
// io.on('connection', (socket) => {
//     console.log('connection');
//
//     console.log(2);
//
//     socket.on('sendChatToServer', (message) => {
//         console.log(3);
//         io.sockets.emit('sendChatToClient', message.message);
//         console.log(message)
//         // io.to("room:12/15").emit('sendChatToClient', message.message);
//
//         // socket.broadcast.emit('sendChatToClient', message);
//     });
//
//
//     socket.on('disconnect', (socket) =>{
//         console.log('disconnect')
//     });
// });
//
// server.listen(5050, ()=>{
//     console.log('server is running, PORT: 5050')
// });

















//
// const { App } = require("uWebSockets.js");
// const { Server } = require("socket.io");
//
// const app = App();
// const io = new Server();
//
// io.attachApp(app);
//
// io.on("connection", (socket) => {
//     console.log(11111)
// });
//
// app.listen(3000, (token) => {
//     if (!token) {
//         console.warn("port already in use");
//     }
// });
