(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
/// <reference path="../../typescript/typescriptAPI/TypeScriptAPIPlugin.d.ts" />
"use strict";

SupCore.system.registerPlugin("typescriptAPI", "Sup.Sound", {
    code: "namespace Sup { export class Sound extends Asset {} }",
    defs: "declare namespace Sup { class Sound extends Asset { dummySoundMember; } }"
});
SupCore.system.registerPlugin("typescriptAPI", "Sup.Audio", {
    code: "namespace Sup {\n  export namespace Audio {\n    export function getMasterVolume(volume) {\n      if (player.gameInstance.audio.getContext() == null) return 0;\n      return player.gameInstance.audio.masterGain.gain.value;\n    }\n    export function setMasterVolume(volume) {\n      if (player.gameInstance.audio.getContext() == null) return;\n      player.gameInstance.audio.masterGain.gain.value = volume;\n    }\n  }\n}\n",
    defs: "declare namespace Sup {\n  namespace Audio {\n    function getMasterVolume(): number;\n    function setMasterVolume(volume: number): void;\n  }\n}\n"
});
SupCore.system.registerPlugin("typescriptAPI", "Sup.Audio.SoundPlayer", {
    code: "namespace Sup {\n  export namespace Audio {\n    export function playSound(pathOrAsset: string|Sound, volume=1.0, options?: { loop?: boolean; pitch?: number; pan?: number; }) {\n      return new SoundPlayer(pathOrAsset, volume, options).play();\n    }\n  \n    export class SoundPlayer {\n      __inner: any;\n      constructor(pathOrAsset: string|Sound, volume=1.0, options?: { loop?: boolean; pitch?: number; pan?: number; }) {\n        let audioCtx = player.gameInstance.audio.getContext();\n        let audioMasterGain = player.gameInstance.audio.masterGain;\n        let soundAsset = (typeof pathOrAsset === \"string\") ? get(pathOrAsset, Sound) : <Sound>pathOrAsset;\n        this.__inner = new SupEngine.SoundPlayer(audioCtx, audioMasterGain, soundAsset.__inner.buffer);\n        this.__inner.setVolume(volume);\n        \n        if (options != null) {\n          if (options.loop != null) this.__inner.setLoop(options.loop);\n          if (options.pan != null) this.__inner.setPan(options.pan);\n          if (options.pitch != null) this.__inner.setPitch(options.pitch);\n        }\n      }\n      play() { this.__inner.play(); return this; }\n      stop() { this.__inner.stop(); return this; }\n      pause() { this.__inner.pause(); return this; }\n      isPlaying() { return this.__inner.getState() === SoundPlayer.State.Playing; }\n      getState() { return this.__inner.getState(); }\n\n      getLoop() { return this.__inner.isLooping; }\n      setLoop(looping) { this.__inner.setLoop(looping); return this; }\n      getVolume() { return this.__inner.volume; }\n      setVolume(volume) { this.__inner.setVolume(volume); return this; }\n      getPan() { return this.__inner.pan; }\n      setPan(pan) { this.__inner.setPan(pan); return this; }\n      getPitch() { return this.__inner.pitch; }\n      setPitch(pitch) { this.__inner.setPitch(pitch); return this; }\n    }\n    \n    export namespace SoundPlayer {\n      export enum State { Playing, Paused, Stopped }\n    }\n  }\n}\n",
    defs: "declare namespace Sup {\n  namespace Audio {\n    function playSound(pathOrAsset: string|Sound, volume?: number /* 1.0 */, options?: { loop?: boolean; pitch?: number; pan?: number; }): SoundPlayer;\n  \n    class SoundPlayer {\n      constructor(pathOrAsset: string|Sound, volume?: number /* 1.0 */, options?: { loop?: boolean; pitch?: number; pan?: number; });\n      play(): SoundPlayer;\n      stop(): SoundPlayer;\n      pause(): SoundPlayer;\n      isPlaying(): boolean;\n      getState(): SoundPlayer.State;\n\n      getLoop(): boolean;\n      setLoop(looping: boolean): SoundPlayer;\n      getVolume(): number;\n      setVolume(volume: number): SoundPlayer;\n      getPan(): number;\n      setPan(pan: number): SoundPlayer;\n      getPitch(): number;\n      setPitch(pitch: number): SoundPlayer;\n    }\n\n    namespace SoundPlayer {\n      enum State { Playing, Paused, Stopped }\n    }\n  }\n}\n"
});

},{}]},{},[1]);